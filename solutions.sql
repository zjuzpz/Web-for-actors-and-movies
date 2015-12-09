/*First find the actor id */
create TEMPORARY table if not exists aid as (
select aid from MovieActor where mid = 
(select id from Movie where title = "Die Another Day"));
/*Then find the name from actor table*/
create temporary table if not exists name as (
select first, last from Actor where id in 
(select * from aid));

select concat_ws(' ', first, last) from name;

/*Find all actors that appears more than once in movieActor*/
create temporary table if not exists t2 as (
select aid from MovieActor group by aid having count(*) >= 2);
/*Count the nums*/
select count(*) from t2;

/* select count(*) from actor;*/
