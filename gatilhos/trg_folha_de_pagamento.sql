create trigger trg_folha_de_pagamento
before insert or update or delete on aluga 
for each row execute procedure folha_pagamento();