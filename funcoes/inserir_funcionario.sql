CREATE OR REPLACE FUNCTION inserir_funcionario(cpf character varying,nome character varying, profissao character varying,
status boolean,cpfadm character varying,numeroRes character varying, numeroCel character varying)
 RETURNS void AS
$BODY$

begin
--inserindo na tabela funcionario
insert into funcionario values(cpf,nome,profissao,status,cpfadm,CURRENT_TIMESTAMP(0));
--inserindo na tabela telefoneFuncionario
insert into "telefoneFuncionario" values(cpf,numeroRes,numeroCel);

--condições para a inserção na tabela funcionario
if length(cpf) <> 11 then
	raise exception 'variavel cpf não contem 11 caracteres'; 
else if nome is null or profissao is null or status is null or cpfadm is null then
	raise exception 'Não é permitida a entrada de valores nulos';
else if nome ='' or profissao ='' or cpfadm ='' then
	raise exception 'Não é permitido a entrada de caracteres em branco';

--condição para a inserção na tabela telefoneFuncionario
else if numeroRes is null or numeroRes = '' or numeroCel is null or numeroCel = '' then
	raise exception 'Obrigatório ter pelo menos um numero para contato';
end if;
end if;
end if;
end if;
--violação da chave primária
exception when unique_violation then 
	raise exception 'Locatário ja cadastrado';
end
$BODY$
LANGUAGE 'plpgsql';
