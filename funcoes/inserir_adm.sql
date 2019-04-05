CREATE OR REPLACE FUNCTION public.inserir_adm(cpf character varying,nome character varying, cidade character varying,
senha character varying, status boolean, estado character varying)
 RETURNS void AS
$BODY$
begin
insert into administrador(cpf,nome,cidade,senha,status,estado) 
values(cpf,nome,cidade,md5(senha),status,estado);
if length(cpf) <> 11 then
	raise exception 'variavel cpf não contem 11 caracteres'; 
else if nome is null or cidade is null or senha is null or status is null
or estado is null then
	raise exception 'Não é permitida a entrada de valores nulos';
end if;
end if;
exception when unique_violation then 
	raise exception 'administrador ja cadastrado';
end
$BODY$
LANGUAGE 'plpgsql';
