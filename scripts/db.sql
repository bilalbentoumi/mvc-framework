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