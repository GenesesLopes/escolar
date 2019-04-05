create or replace function consulta_adm(admx_cpf character varying,senha_adm character varying) 
RETURNS TABLE(adm_cpf character varying,adm_nome character varying, adm_cidade character varying, adm_senha character varying,
adm_status boolean, adm_estado character varying, adm_datacadastro timestamp) AS
$BODY$
begin
return query
select * from funcionario where cpf = admx_cpf and senha = senha_adm;
if admx_cpf is null or admx_cpf ='' then
raise exception 'campo CPF em branco ou nulo';
end if;
if length(admx_cpf) != 11 then
raise exception 'O cpf não contem 11 caracteres';
end if;
end;
$BODY$
LANGUAGE 'plpgsql';