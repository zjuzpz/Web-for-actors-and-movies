<!--
    Search page.
 -->
<!DOCTYPE html>
<html>
    <head>
	<title>
		Search result
	</title>
    </head>
    <body>
	<h3>Search result </h3>

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $db_connection = mysql_connect("localhost", "root", "root");
    mysql_select_db("movie", $db_connection);
  // collect value of input field
    $type = $_GET["type"];
    $id = $_GET["id"];
    if($type == "movie") {
	print "<h4>Movie info:</h4>";
        $query = "select * from movie where id = ".$id.";";
        $rs = mysql_query($query, $db_connection);
        print "<table border=3> ";
        $len = mysql_num_fields($rs);
	    print "<tr>";
	    for($i=0;$i<$len;$i++){
	        print "<td style='text-align:center'>".mysql_field_name($rs,$i)."</td>";
	    }
	     print "</tr>";
	     while($row = mysql_fetch_row($rs)){
             print "<tr>";
                 for($i=0;$i<count($row);$i++){			
		     $val = $row[$i];
	             if($val){
	                 print "<td>"."$val "."</td>";
                     } else {print "<td>N/A</td>";}  
                 } 
             print "</tr>";
	     }
	print "</table>";	    
        $query = "select genre from movieGenre where mid = ".$id.";";
        $rs = mysql_query($query, $db_connection);
	print "Movie Genre: ";
	if($row = mysql_fetch_row($rs)) {print $row[0]."</br>";}
        $query = "select did from movieDirector where mid = ".$id.";";
        $rs = mysql_query($query, $db_connection);
	if($row = mysql_fetch_row($rs)) {
	    $query = "select first, last from director where id = ".$row[0];
	    $rs = mysql_query($query, $db_connection);
	    if($row = mysql_fetch_row($rs)) {
                print "Director name: ".$row[0]." ".$row[1]."</br>";
	    }
        }
	print "Actors in this movie: </br>";
        $query = "select aid, role from movieActor where mid = ".$id.";";
        $rs = mysql_query($query, $db_connection);
        while($row = mysql_fetch_row($rs)) {
	    $query_actor = "select first, last from actor where id = ".$row[0].";";	
            $rs_actor = mysql_query($query_actor, $db_connection);
            if($row_actor = mysql_fetch_row($rs_actor)) {
		print "<a href=searchresult.php?type=actor&id=".$row[0].">".$row_actor[0]." ".$row_actor[1]."</a>";
                print " act as";
	    }
	    print "\"".$row[1]."\"</br>";
	}
	print "Comments:</br>";
        $query = "select name, time, rating, comment from review where mid = ".$id.";";
        $rs = mysql_query($query, $db_connection);
	while($row = mysql_fetch_row($rs)) {
	    print "Reviewer: ".$row[0]."</br>";
	    print "Time: ".$row[1]."</br>";
	    print "Rating: ".$row[2]."</br>";
	    print "Comments: ".$row[3]."</br></br>";	
	}
    } else if($type == "actor") {
	print "<h4>Actor info:</h4>";
        $query = "select * from actor where id = ".$id.";";
        $rs = mysql_query($query, $db_connection);
        print "<table border=3> ";
        $len = mysql_num_fields($rs);
	    print "<tr>";
	    for($i=0;$i<$len;$i++){
	        print "<td style='text-align:center'>".mysql_field_name($rs,$i)."</td>";
	    }
	     print "</tr>";
	     while($row = mysql_fetch_row($rs)){
             print "<tr>";
                 for($i=0;$i<count($row);$i++){			
		     $val = $row[$i];
	             if($val){
	                 print "<td>"."$val "."</td>";
                     } else {print "<td>N/A</td>";}  
                 } 
             print "</tr>";
	     }
	print "</table>";
	print "Actor in: </br>";
        $query = "select mid, role from movieActor where aid = ".$id.";";
//	print $query;
        $rs = mysql_query($query, $db_connection);
        while($row = mysql_fetch_row($rs)) {
	    $query_movie = "select title from movie where id = ".$row[0].";";	
            $rs_movie = mysql_query($query_movie, $db_connection);
            if($row_movie = mysql_fetch_row($rs_movie)) {
		print "Act in <a href=searchresult.php?type=movie&id=".$row[0].">".$row_movie[0]."</a>";
                print " as ";
	    }
	    print "\"".$row[1]."\"</br>";
	}
    } else {print "Please browse this page from the search page!";}
    mysql_close($db_connection); 
}
?>

    </body>
</html>
