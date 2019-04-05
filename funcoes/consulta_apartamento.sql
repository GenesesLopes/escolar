create or replace function consulta_apartamento(apx_idapartamento integer)
returns table (ap_numeroap integer, ap_quartos integer, ap_idapartamento integer ,ap_idedificio integer,ap_datacadastro timestamp)
as $$

begin

return query
select * from apartamento where idapartamento = apx_idapartamento;

end;
$$

language 'plpgsql';
