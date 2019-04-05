CREATE OR REPLACE FUNCTION atualiza_edificio(ed_bairro character varying, ed_numero integer,ed_cep character varying,
ed_rua character varying,ed_nome character varying,ed_id integer)
 RETURNS void AS
$BODY$

begin

--atualizando na tabela eficicio
update edificio set bairro = ed_bairro, numero = ed_numero, cep = ed_cep,
rua = ed_rua, nome = ed_nome where idedificio  = ed_id;

--condições para a atualização na tabela edificio

if ed_nome ='' or ed_bairro='' or ed_cep = '' or ed_rua = '' then
	raise exception 'Não é permitido a entrada de caracteres em branco';
end if;
--violação de valores nulos
exception when not_null_violation then 
	raise exception 'Não é permitida a entrada de valores nulos';
end
$BODY$
LANGUAGE 'plpgsql';