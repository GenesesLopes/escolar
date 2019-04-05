create or replace function folha_pagamento()
returns trigger 
as $$
begin

if TG_OP = 'INSERT' then --gatilho disparando quando acontece o insert na tabela aluga
	if new.pagamento is true then
		insert into folhapagamento values(new.cpf, new.idapartamento, new.datapagamento, current_user, TG_OP, current_timestamp(0), null);
		return new;
	else
		insert into folhapagamento values(new.cpf,new.idapartamento,null,current_user,TG_OP,current_timestamp(0),null);
		return new;
	end if;
else if TG_OP ='UPDATE' then --gatilho disparando quando acontece o update na tabela aluga
	if new.pagamento is true then
		update folhapagamento set datapagefetuado = new.datapagamento, usuariobd = current_user, ultimaop = TG_OP,
		dataalteracao = current_timestamp(0) where cpf = new.cpf and idapartamento = new.idapartamento;
		return new;
	end if;
else if TG_OP = 'DELETE' then --gatilho disparando quando acontece o delete na tabela aluga
	delete from folhapagamento where idapartamento = old.idapartamento and cpf = old.cpf;
	return old;
	--delete from aluga where id_apartamento_aluga = old.idapartamento and cpf_aluga = old.cpf; colocar no procedimento de exclusão
end if;
end if;
end if;
end
$$
language 'plpgsql';
	