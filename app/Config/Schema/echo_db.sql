create table posts
(
	id       serial
		primary key,
	title    varchar(50),
	body     text,
	created  timestamp default CURRENT_TIMESTAMP,
	modified timestamp default CURRENT_TIMESTAMP,
	user_id  serial
);

alter table posts
	owner to postgres;

create table users
(
	id       serial
		primary key,
	username varchar(50),
	password varchar(255),
	role     varchar(20),
	created  timestamp default CURRENT_TIMESTAMP,
	modified timestamp default CURRENT_TIMESTAMP
);

alter table users
	owner to postgres;

create table posts_tags
(
	id      serial
		primary key,
	tag_id  serial,
	post_id serial
);

alter table posts_tags
	owner to postgres;

create table tags
(
	id       serial
		primary key,
	nome     varchar(50),
	created  timestamp default CURRENT_TIMESTAMP,
	modified timestamp default CURRENT_TIMESTAMP
);

alter table tags
	owner to postgres;

