create or replace function consulta_edificio( idx_edificio integer)
returns table (ed_id integer, ed_bairro character varying, ed_numero integer, ed_cep character varying,
ed_rua character varying, ed_nome character varying, ed_cpfadm character varying, datacadastro timestamp)
as $$
begin

return query
select * from edificio where idedificio = idx_edificio;

--validando entrada
if idx_edificio <=0 or idx_edificio is null then
	raise exception 'entrada invalida';
end if;
end;
$$
language 'plpgsql';
