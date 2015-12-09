/*
Test integrity of the database
1) the mid in movieGenre table should appear in movie table;
2) the mid in movieDirector table should appear in movie table;
3) the did in movieDirector table should appear in director table;
4) the mid in movieActor table should appear in movie table;
5) the aid in movieActor table should appear in actor table;
6) the mid in review table should appear in movie table;
7) the id in movie table should > 0;
8) the year in movie table should in range(1800, 2100);
9) the id in actor table should > 0;
10) the id in director table should > 0;
11) there are lots of attributes should neverbe null when inserting data in database, here I do not test it. And also notice the check condition may not be supported by mySQL. 
*/

/*Test 1*/
insert into MovieGenre values(2000000, "action");
/*Test 2*/
insert into MovieDirector values(2000000, 37146);*/
/*Test 3*/
insert into MovieDirector values(272,2000000);*/
/*Test 4*/
insert into MovieActor values(2000000,10,"role");*/
/*Test 5*/
insert into MovieActor values(272, 2000000, "role");*/
/*Test 6*/
insert into Review values("name", null, 2000000, 5, "comment");*/
/*Notice: From test7, the constraints are set by check statements, which are not supported by mySQL!*/
/*Test 7*/
/*insert into movie values(-1, "movie", 2001, null, "company");*/
/*Test 8*/
/*insert into movie values(9000, "movie", 2101, null, "company");*/
/*Test 9*/
/*insert into actor values(-1, "last", "first", "male", 19870608, null);*/
/*Test 10*/
/*insert into director values(-1, "last", "first", 19870608, null);*/
