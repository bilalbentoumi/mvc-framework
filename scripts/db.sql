create table user
(
    user_id int auto_increment primary key,
    username VARCHAR(255) null,
    password VARCHAR(255) null,
    user_email VARCHAR(255) null,
    user_status int null,
    user_create_date VARCHAR(255) null,
    user_update_date VARCHAR(255) null
);

create table category
(
    category_id int auto_increment primary key,
    category_name VARCHAR(255) null,
    category_link VARCHAR(255) null,
    category_description VARCHAR(255) null,
    category_status int null,
    category_create_date VARCHAR(255) null,
    category_update_date VARCHAR(255) null
);

create table category_field
(
    field_id int auto_increment primary key,
    category_id int,
    field_type int,
    field_name VARCHAR(255) null,
    field_label VARCHAR(255) null,
    field_required int null,
    field_create_date VARCHAR(255) null
);

create table category_field_option
(
    option_id int auto_increment primary key,
    field_id int,
    option_name VARCHAR(255) null,
    option_value VARCHAR(255) null,
    option_create_date VARCHAR(255) null
);