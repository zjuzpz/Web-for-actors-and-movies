/*
1) Only InnoDB storage engine supports foreign key constraints
2) Check constraints are not supported in MySQL nor are general SQL assertions :(
*/
drop table if exists movieDirector cascade;
drop table if exists movieActor cascade;
drop table if exists review cascade;
drop table if exists movieGenre cascade;
drop table if exists actor cascade;
drop table if exists movie cascade;
drop table if exists director cascade;
drop table if exists maxPersonID cascade;
drop table if exists maxMovieID cascade;

create table movie
(
id integer not null comment 'movie ID',
title varchar(100) not null comment 'movie title',
year integer not null comment "release year",
rating varchar(10) comment "MPAA rating",
company varchar(50) not null comment "production company",
primary key(id),
check(year >= 1800 and year <= 2100),
check(id > 0)
) ENGINE=INNODB;

create table actor
(
id integer not null comment "actor ID",
last varchar(20) not null comment "last name",
first varchar(20) not null comment "first name",
sex varchar(6) comment "sex of the actor",
dob date not null comment "date of brith",
dod date comment "date of death",
primary key(id),
check(id > 0)
) ENGINE=INNODB;

create table director
(
id integer not null comment "director ID",
last varchar(20) not null comment "last name",
first varchar(20) not null comment "firsr name",
dob date not null comment "date of birth",
dod date comment "date of death",
primary key(id),
check(id > 0)
) ENGINE=INNODB;

create table movieGenre
(
mid integer not null comment "movie ID",
genre varchar(20) not null comment "movie genre",
foreign key(mid) references movie(id)
) ENGINE=INNODB;

create table movieDirector
(
mid integer not null comment "movie ID",
did integer not null comment "director ID",
foreign key(mid) references movie(id),
foreign key(did) references director(id)
) ENGINE=INNODB;

create table movieActor
(
mid integer not null comment "movie ID",
aid integer not null comment "actor ID",
role varchar(50) comment "actor role in movie",
foreign key(mid) references movie(id),
foreign key(aid) references actor(id)
) ENGINE=INNODB;

create table review
(
name varchar(20) not null comment "reviewer name",
time timestamp comment "review time",
mid integer not null comment "movie ID",
rating integer comment "review rating",
comment varchar(500) not null comment "reviewer comment",
foreign key(mid) references movie(id)
) ENGINE=INNODB;

create table maxPersonID 
(
id int comment "max ID assigned to all persons",
check(id >= 0)
) ENGINE=INNODB;

create table maxMovieID
(
id int comment "max ID assigned to all movies",
check(id >= 0)
) ENGINE=INNODB;

