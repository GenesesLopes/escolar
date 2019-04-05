create or replace function consulta_apartamento_cadastro_locatario(apx_idedificio integer)
returns table (ap_id integer, ap_numero integer, ap_quartos integer)
as $$

begin
--Retornar somente apartamentos que não estão alugados
return query
select apartamento.idapartamento, apartamento.numeroap,apartamento.quartos from apartamento where apartamento.idapartamento not in (select aluga.idapartamento from aluga)
and apartamento.idedificio = apx_idedificio;

end;
$$
language 'plpgsql';

