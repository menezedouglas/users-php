-- set default database
use users_php;

create or replace view vw_users_by_cities as
select name                      as city,
       (select count(*)
        from users u,
             addresses a,
             user_addresses ua
        where a.city_id = c.id
          and ua.address_id = a.id
          and u.id = ua.user_id) as users
from cities c;

create or replace view vw_users_by_states as
select s.name                    as state,
       s.code                    as uf,
       (select count(*)
        from users u,
             addresses a,
             user_addresses ua
        where a.state_id = s.id
          and ua.address_id = a.id
          and u.id = ua.user_id) as users
from states s;

select version();
