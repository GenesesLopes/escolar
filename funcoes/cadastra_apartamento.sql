CREATE OR REPLACE FUNCTION cadastra_apartamento(ap_idedificio integer, ap_numero integer,ap_quartos integer)
 RETURNS void AS
$BODY$

begin
--verificando se o apartamento já foi cadastrado
if (select count(*) from apartamento where idedificio = ap_idedificio and numeroap = ap_numero) > 0 then
	raise exception 'Apartamento já cadastrado';
end if;

--inserindo na tabela apartamento
insert into apartamento values(ap_numero,ap_quartos,default,ap_idedificio,CURRENT_TIMESTAMP(0));

--violação de valores não nulos
exception when not_null_violation then 
	raise exception 'Não é permitida a entrada de valores nulos';
end
$BODY$
LANGUAGE 'plpgsql';