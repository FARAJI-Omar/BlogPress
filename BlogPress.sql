-- create database
create database BlogPress;
use BlogPress;

-- create tables
-- 1. users table
create table users (
    id int auto_increment primary key,
    username varchar(50) not null unique,
    email varchar(50) not null unique,
    password varchar(20) not null,
    role enum('author', 'visitor') not null,
    created_at timestamp default current_timestamp
);

-- 2. articles table
create table articles (
    id int auto_increment primary key,
    title varchar(50) not null,
    content text not null,
    author_id int not null,
    views int default 0,
    likes int default 0,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    foreign key (author_id) references users(id)
);

-- 3. comments table
create table comments (
    id int auto_increment primary key,
    article_id int not null,
    user_id int not null,
    content text not null,
    created_at timestamp default current_timestamp,
    foreign key (article_id) references articles(id) on delete cascade,
    foreign key (user_id) references users(id)
);

-- 4. article_statistics table
create table article_statistics (
    id int auto_increment primary key,
    article_id int not null,
    date date not null,
    views int default 0,
    likes int default 0,
    comments int default 0,
    foreign key (article_id) references articles(id) on delete cascade,
    unique (article_id, date) -- to ensure only one record per article per day
);


