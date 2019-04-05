create trigger trg_relatorio_problema before update
on problema for each row 
execute procedure relatorio_problema();