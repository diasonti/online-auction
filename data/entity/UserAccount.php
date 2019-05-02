<?php

/*
create table user_account
(
	id bigint auto_increment
		primary key,
	email varchar(255) not null,
	password varchar(255) not null,
	full_name varchar(255) null,
	birth_date date null,
	constraint user_account_email_uindex
		unique (email)
);
*/


class UserAccount {

    public $id;
    public $email;
    public $password;

    public $fullName;

}