﻿CREATE OR REPLACE FUNCTION public.cadastra_problema(
    idapartamento integer,
    natureza character varying,
    descicao text,cpf character varying)
  RETURNS void AS
$BODY$

begin
--inserindo na tabela problema
insert into problema values(default,idapartamento,natureza,descricao,default,CURRENT_TIMESTAMP(0),cpf);

--tratamento para a inserção na tabela problema
if natureza = '' then
	raise exception 'Favor, fornecer a natureza do problema';
if descricao = ''then
	raise exception 'Favor, fornecer a descrição do problema';
end if;
end if;

--violação de valores não nulos
exception when not_null_violation then 
	raise exception 'Não é permitida a entrada de valores nulos';
end
$BODY$
  LANGUAGE 'plpgsql';