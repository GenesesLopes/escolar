CREATE OR REPLACE FUNCTION consulta_funcionario(funcx_cpf character varying)
RETURNS TABLE(func_cpf character varying,func_nome character varying, func_profissao character varying, func_status boolean,
func_cpfadm character varying, func_datacadastro timestamp) AS
$BODY$
begin
return query
select * from funcionario where cpf = funcx_cpf;
if funcx_cpf is null or funcx_cpf ='' then
raise exception 'campo CPF em branco ou nulo';
end if;
if length(funcx_cpf) != 11 then
raise exception 'O cpf não contem 11 caracteres';
end if;
end;
$BODY$
LANGUAGE 'plpgsql';