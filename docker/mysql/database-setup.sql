create table my_database.users
(
    id       int auto_increment
        primary key,
    username varchar(255) not null,
    email    varchar(255) not null
);

create index email
    on my_database.users (email);

insert into my_database.users (username, email)
values
    ('John Doe', 'john.doe@example.com'),
    ('Jane Doe', 'jane.doe@example.com');