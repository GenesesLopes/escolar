create or replace function relatorio_problema()
returns trigger 
as $$
begin

--verificando se é atualização no atributo status
if new.status is true then
insert into "relatorioProblema" values(new.idproblema,current_timestamp(0),new.cpf,current_user,TG_OP);
return new;
end if;
end
$$
language 'plpgsql';