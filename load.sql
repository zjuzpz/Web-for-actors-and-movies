
load data local infile 'data/movie.del' INTO TABLE movie fields terminated BY ',' optionally enclosed by '"';

load data local infile 'data/actor1.del' into table actor fields terminated by ',' optionally enclosed by '"';

load data local infile 'data/actor2.del' into table actor fields terminated by ',' optionally enclosed by '"';

load data local infile 'data/actor3.del' into table actor fields terminated by ',' optionally enclosed by '"';

load data local infile 'data/director.del' into table director fields terminated by ',' optionally enclosed by '"';

load data local infile 'data/moviegenre.del' into table movieGenre fields terminated by ',' optionally enclosed by '"';

load data local infile 'data/moviedirector.del' into table movieDirector fields terminated by ',' optionally enclosed by '"';

load data local infile 'data/movieactor1.del' into table movieActor fields terminated by ',' optionally enclosed by '"';

load data local infile 'data/movieactor2.del' into table movieActor fields terminated by ',' optionally enclosed by '"';

insert into maxPersonID values(69000);
insert into maxMovieID values(4750);
