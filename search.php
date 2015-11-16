<!--
    Search page.
 -->
<!DOCTYPE html>
<html>
    <head>
	<title>
		Search movie or actor
	</title>
    </head>
    <body>
	<h3>Search movie or actor </h3>
	<?php
 	    $db_connection = mysql_connect("localhost", "root", "root");
 	    mysql_select_db("movie", $db_connection);
	?>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"> 
	     <style>.required {color:#ff0000;} </style>
	     Search <input type="text" name="search" style="font-size:18px; width:250px;"> </br>
	     <input type="submit" value="search">
	</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $search = $_POST["search"];
    if (empty($search)) {
        echo "Please input the name of an actor or a movie";
    } else {
	$s = split(" ", $search);
	$first = $s[0];
	if(count($s) == 2) {
	    $last = $s[1];
	} else {$last = Null;}
	//search by movie
	$query1 = "select id from movie where title like \"%".$search."%\";";
	//search by actor
	if(!empty($last)) {
	    $query2 = "select id from actor where first = \"".$first."\" and last = \"".$last."\";";
            $query3 = NUll;
	} else if(count($s) == 1) {
	    $query2 = "select id from actor where first = \"".$first."\";";
	    $query3 = "select id from actor where last = \"".$first."\";";
	} else {
	    $query2 = Null;
	    $query3 = NUll;
	}
//	echo "%\"\"%";
//	echo $query1."</br>";
//	echo $query2."</br>";
//	echo $query3."</br>";

//search movie by title
	$rs1 = mysql_query($query1, $db_connection);
	while($row1 = mysql_fetch_row($rs1)) {
	    for($i=0;$i<count($row1);$i++) {
	        if($row1[$i]) {
	    	    $mid = $row1[$i];
		    $query_movie = "select title from movie where id = ".$mid.";";
		    $rs_movie = mysql_query($query_movie, $db_connection);
		    if($row_movie = mysql_fetch_row($rs_movie)) {
		        echo "Movie: ".$row_movie[0]."</br>";	    
		    } 
	        }  
	    }
	}
//search actor by first and last or first;

	$rs2 = mysql_query($query2, $db_connection);
	while($row2 = mysql_fetch_row($rs2)) {
	    for($i=0;$i<count($row2);$i++) {
	        if($row2[$i]) {
		    $aid = $row2[$i];
                    $query_actor = "select first, last from actor where id = ".$aid.";";
                    $rs_actor = mysql_query($query_actor, $db_connection);
                    if($row_actor = mysql_fetch_row($rs_actor)) {
                        echo "Actor: ".$row_actor[0]." ".$row_actor[1]."</br>";
	            }
	        }
	    }
        }
//search actor by last name
	$rs3 = mysql_query($query3, $db_connection);
	while($row3 = mysql_fetch_row($rs3)) {
            for($i=0;$i<count($row3);$i++) {
                if($row3[$i]) {
                    $aid = $row3[$i];
                    $query_actor = "select first, last from actor where id = ".$aid.";";
                    $rs_actor = mysql_query($query_actor, $db_connection);
                    if($row_actor = mysql_fetch_row($rs_actor)) {
                    echo "Actor: ".$row_actor[0]." ".$row_actor[1]."</br>";
                    }
	        }
	    }
        }
    }
}

?>

<?php 
    mysql_close($db_connection); 
?>

    </body>
</html>
