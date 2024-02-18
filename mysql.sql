create table if not exists auto(
    id int auto_increment primary key,
    brand varchar(255) not null,
    model varchar(255) not null,
    odometer int not null,
    year int not null,
    price_amount int not null,
    price_currency varchar(3) not null,
    is_actual tinyint default 0 not null
    );
