/*
1) Only InnoDB storage engine supports foreign key constraints
2) Check constraints are not supported in MySQL nor are general SQL assertions :(
*/
drop table if exists MovieDirector cascade;
drop table if exists MovieActor cascade;
drop table if exists Review cascade;
drop table if exists MovieGenre cascade;
drop table if exists Actor cascade;
drop table if exists Movie cascade;
drop table if exists Director cascade;
drop table if exists MaxPersonID cascade;
drop table if exists MaxMovieID cascade;

create table Movie
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

create table Actor
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

create table Director
(
id integer not null comment "director ID",
last varchar(20) not null comment "last name",
first varchar(20) not null comment "firsr name",
dob date not null comment "date of birth",
dod date comment "date of death",
primary key(id),
check(id > 0)
) ENGINE=INNODB;

create table MovieGenre
(
mid integer not null comment "movie ID",
genre varchar(20) not null comment "movie genre",
foreign key(mid) references Movie(id)
) ENGINE=INNODB;

create table MovieDirector
(
mid integer not null comment "movie ID",
did integer not null comment "director ID",
foreign key(mid) references Movie(id),
foreign key(did) references Director(id)
) ENGINE=INNODB;

create table MovieActor
(
mid integer not null comment "movie ID",
aid integer not null comment "actor ID",
role varchar(50) comment "actor role in movie",
foreign key(mid) references Movie(id),
foreign key(aid) references Actor(id)
) ENGINE=INNODB;

create table Review
(
name varchar(20) not null comment "reviewer name",
time timestamp comment "review time",
mid integer not null comment "movie ID",
rating integer comment "review rating",
comment varchar(500) not null comment "reviewer comment",
foreign key(mid) references Movie(id)
) ENGINE=INNODB;

create table MaxPersonID 
(
id int comment "max ID assigned to all persons",
check(id >= 0)
) ENGINE=INNODB;

create table MaxMovieID
(
id int comment "max ID assigned to all movies",
check(id >= 0)
) ENGINE=INNODB;

