-- Active: 1706004842106@@127.0.0.1@3306@dwwm_cmfp
--!-------add collone phone in table user ---------
alter table user add photo VARCHAR(250);


--!-------Create Table user---------
create table user (
    id int auto_increment PRIMARY key,
    username varchar(250) not null UNIQUE,
    email varchar(100),
    password varchar(200) NOT NULL,
    confirmPassword VARCHAR(200),
    dateCreation datetime default now (),
    dateModification datetime default now (),
    derniereConnexion datetime,
    roles json
);





----?------Insertion de données---------
insert into
    user (username, email, password, roles)
values
    (
        'sherpa',
        'sherpa@localhost.com',
        sha ('1234'),
        '["ROLE_ADMIN","ROLE_DEPOT","ROLE_CAISSE","ROLE_USER"]'
    ),
    (
        'paul',
        'paul@localhost.com',
        sha ('1234'),
        '["ROLE_DEPOT","ROLE_CAISSE","ROLE_USER"]'
    ),
    (
        'marie',
        'marie@localhost.com',
        sha ('1234'),
        '["ROLE_CAISSE","ROLE_USER"]'
    ),
    (
        'admin',
        'admin@localhost.com',
        sha ('1234'),
        '["ROLE_ADMIN","ROLE_DEPOT","ROLE_CAISSE","ROLE_USER"]'
    );

   

--sha is method sql to hash the password.
----!Creation de table role-----------------
create table role (
    id int auto_increment primary key,
    rang VARCHAR(20),
    libelle varchar(200)
);

------?insertion de donnee das le table role---------
insert into
    role (rang, libelle)
values
    ('001', 'ROLE_ADMIN'),
    ('002', 'ROLE_DEPOT'),
    ('003', 'ROLE_CAISSE'),
    ('004', 'ROLE_USER'),
     ('OO5','ROLE_DEV'),
    ('006','ROLE_ASSISTANT');
   


    -- Update name of roles
start transaction;
update role set libelle  = 'ROLE_DEPOT' where rang ='002';
COMMIT;
update role set libelle = 'ROLE_CAISSE' where rang = '003';

