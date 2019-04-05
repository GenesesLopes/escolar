CREATE OR REPLACE FUNCTION cadastra_edificio(ed_bairro character varying, ed_numero integer,ed_cep character varying,
ed_rua character varying,ed_nome character varying,ed_cpfadm character varying)
 RETURNS void AS
$BODY$

begin
--verificando se o edificio já esta cadastrado
if (select count(*) from edificio where nome = ed_nome and cpfadm = ed_cpfadm) > 0 then
	raise exception 'Edificio já cadastrado';
end if;

--inserindo na tabela eficicio
insert into edificio values(default,ed_bairro,ed_numero,ed_cep,ed_rua,ed_nome,ed_cpfadm,CURRENT_TIMESTAMP(0));



--condições para a inserção na tabela edificio

if ed_nome ='' or ed_cpfadm ='' or ed_bairro='' or ed_cep = '' or ed_rua = '' then
	raise exception 'Não é permitido a entrada de caracteres em branco';
end if;
--violação de valores não nulos
exception when not_null_violation then 
	raise exception 'Não é permitida a entrada de valores nulos';
end
$BODY$
LANGUAGE 'plpgsql';