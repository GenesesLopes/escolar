CREATE OR REPLACE FUNCTION consulta_locatario(locx_cpf character varying)
RETURNS TABLE(loc_cpf character varying, loc_rg character varying, loc_nome character varying, loc_status boolean, loc_cpfadm character varying, loc_nascimento date, loc_datacadastro timestamp without time zone) AS
$BODY$
begin
return query
select * from locatario where cpf = locx_cpf;

if locx_cpf is null or locx_cpf ='' then
raise exception 'campo CPF em branco ou nulo';
end if;
if length(locx_cpf) != 11 then
raise exception 'O campo não contem 11 caracteres';
end if;

end;
$BODY$
LANGUAGE 'plpgsql';
