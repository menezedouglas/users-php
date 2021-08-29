-- drop schema
drop schema if exists users_php;

-- create a new schema
create schema if not exists users_php;

-- set default database
use users_php;

-- create users table
create table if not exists users
(
    id         int          not null auto_increment,
    name       varchar(90)  not null,
    email      varchar(255) not null unique ,
    age        int          not null,
    created_at timestamp    not null default now(),
    updated_at timestamp    not null default now(),
    deleted_at timestamp,
    primary key (id) 
);

-- create table states
create table if not exists states
(
    id         int         not null auto_increment,
    name       varchar(60) not null unique,
    code       char(3)     not null unique,
    created_at timestamp   not null default now(),
    updated_at timestamp   not null default now(),
    deleted_at timestamp,
    primary key (id) 
);

-- create table cities
create table if not exists cities
(
    id         int         not null auto_increment,
    name       varchar(60) not null unique ,
    created_at timestamp   not null default now(),
    updated_at timestamp   not null default now(),
    deleted_at timestamp,
    primary key (id) 
);

-- create table addresses
create table if not exists addresses
(
    id          int         not null auto_increment,
    street      varchar(90) not null,
    location    varchar(90) not null,
    state_id    int         not null,
    city_id     int         not null,
    postal_code bigint      not null unique,
    created_at  timestamp   not null default now(),
    updated_at  timestamp   not null default now(),
    deleted_at  timestamp,
    primary key (id), 
    constraint fk_addresses_state_id foreign key (state_id) references states (id),
    constraint fk_addresses_city_id foreign key (city_id) references cities (id)
);

-- create table user addresses
create table if not exists user_addresses
(
    id         int       not null auto_increment,
    user_id    int       not null,
    address_id int       not null,
    number     bigint    not null,
    complement varchar(255) null,
    created_at timestamp not null default now(),
    updated_at timestamp not null default now(),
    deleted_at timestamp,
    primary key (id), 
    constraint fk_user_addresses_user_id foreign key (user_id) references users (id),
    constraint fk_user_addresses_address_id foreign key (address_id) references addresses (id)
);