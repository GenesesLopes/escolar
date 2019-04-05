select inserir_locatario('12345678900','1463618069','Geneses',true,'12345678911','1993-12-14','36413993','82481405',2,'2017-10-31',false);

CREATE OR REPLACE FUNCTION inserir_locatario(cpf character varying,rg character varying,nome character varying,
status boolean,cpfadm character varying, nascimento date, numeroRes character varying, numeroCel character varying,
idapartamento integer, datapagamento date, pagamento boolean)
 RETURNS void AS
$BODY$

begin
--inserindo na tabela locatario
insert into locatario values(cpf,rg,nome,status,cpfadm,nascimento,CURRENT_TIMESTAMP(0));
--inserindo na tabela telefoneLocatario
insert into telefonelocatario values(cpf,numeroRes,numeroCel);
--inserindo na tabela aluga
insert into aluga values (idapartamento,cpf,datapagamento,pagamento);

--condições para a inserção na tabela locatário
if length(cpf) <> 11 then
	raise exception 'variavel cpf não contem 11 caracteres'; 
else if nome is null or rg is null or cpfadm is null
or nascimento is null then
	raise exception 'Não é permitida a entrada de valores nulos';
else if nome ='' or rg ='' or cpfadm =''or nascimento is null then
	raise exception 'Não é permitido a entrada de caracteres em branco';
--condição para a inserção na tabela telefoneLocatario
else if numeroRes is null or numeroRes = '' or numeroCel is null or numeroCel = '' then
	raise exception 'Obrigatório ter pelo menos um numero para contato';
--condição para a inserção na tabela aluga
else if datapagamento is null then
	raise exception 'obrigatório a data de pagamento do aluguel';
end if;
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
