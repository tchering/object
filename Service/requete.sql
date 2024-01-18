-- Active: 1704897572558@@127.0.0.1@3306@dwwm_cmfp
--!-------Create Table user---------
create table user (
    id int auto_increment PRIMARY key,
    username varchar(250) not null UNIQUE,
    email varchar(100),
    password varchar(200) NOT NULL,
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
        '["ROLE_ADMIN","ROLE_ASSIST","ROLE_DEV","ROLE_USER"]'
    ),
    (
        'paul',
        'paul@localhost.com',
        sha ('1234'),
        '["ROLE_ASSIST","ROLE_DEV","ROLE_USER"]'
    ),
    (
        'marie',
        'marie@localhost.com',
        sha ('1234'),
        '["ROLE_DEV","ROLE_USER"]'
    ),
    (
        'admin',
        'admin@localhost.com',
        sha ('1234'),
        '["ROLE_ADMIN","ROLE_ASSIST","ROLE_DEV","ROLE_USER"]'
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
    ('002', 'ROLE_ASSISTANT'),
    ('003', 'ROLE_DEV'),
    ('004', 'ROLE_USER');