create table movie
(
id int comment 'movie ID',
title varchar(100) comment 'movie title',
year int comment "release year",
rating varchar(10) comment "MPAA rating",
company varchar(50) comment "production company"
);

create table actor
(
id int,
last varchar(20) comment "actor ID",
first varchar(20) comment "last name",
sex varchar(6) comment "sex of the actor",
dob date comment "date of brith",
dod date comment "date of death"
);

create table director
(
id int comment "director ID",
last varchar(20) comment "last name",
first varchar(20) comment "firsr name",
dob date comment "date of birth",
dod date comment "date of death"
);

create table movieGenre
(
mid int comment "movie ID",
genre varchar(20) comment "movie genre"
);

create table movieDirector
(
mid int comment "movie ID",
did int comment "director ID"
);

create table movieActor
(
mid int comment "movie ID",
aid int comment "actor ID",
role varchar(50) comment "actor role in movie"
);

create table review
(
name varchar(20) comment "reviewer name",
time timestamp comment "review time",
mid int comment "movie ID",
rating int comment "review rating",
comment varchar(500) comment "reviewer comment"
);

create table maxPersonID
(
id int comment "max ID assigned to all persons"
);

create table maxMovieID
(
id int comment "max ID assigned to all movies"
);
