<!--
    Page I1: A page that lets users to add actor and/or director information. e.g. Here are some "reasonable" names: Chu-Cheng Hsieh, J'son Lee, etc.
    Page I2: A page that lets users to add movie information.
    Page I3: A page that lets users to add comments to movies.
    Page I4: A page that lets users to add "actor to movie" relation(s).
    Page I5: A page that lets users to add "director to movie" relation(s).
 -->
<!DOCTYPE html>
<html>
    <head>
	<title>
		"Add actor to movie relations"
	</title>
    </head>
    <body>
	<h3>Add actor to movie </h3>
	<?php
 	    $db_connection = mysql_connect("localhost", "root", "root");
 	    mysql_select_db("movie", $db_connection);
	    $query = "select title from movie;";
	    $rs = mysql_query($query, $db_connection);
	    $query2 = "select first, last from actor;";
	    $rs2 = mysql_query($query2, $db_connection);
	?>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"> 
	     <style>.required {color:#ff0000;} </style>
	     Title <select name="title"> 
	   	     <?php while($row = mysql_fetch_row($rs)) { ?>
		         <option><?php echo $row[0];?></option>
		     <?php } ?>
		 </select> </br>
	     Actor <select name="actor">
	             <?php while($row = mysql_fetch_row($rs2)) { ?>
		         <option><?php echo $row[0]." ".$row[1]; ?></option>
		     <?php } ?>
		 </select> </br>
	    Role <input type="text" name="role" style="font-size:18px; width:250px;"> </br>
	    <input type="submit" value="add relation!">
	</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $title = $_POST["title"];
    $actor = $_POST["actor"];
    $role = $_POST["role"];
    if (empty($title) or empty($role) or empty($actor)) {
        echo "Please input actor rule in the movie!";
    } else {
	$s = split(" ", $actor);
	$first = $s[0];
	if(count($s) > 1) {
	    $last = $s[1];
	} else {$last = Null;}
	$query1 = "select id from movie where title = \"".$title."\";";
	$query2 = "select id from actor where first = \"".$first."\" and last = \"".$last."\";";
	$rs1 = mysql_query($query1, $db_connection);
	$rs2 = mysql_query($query2, $db_connection);
	$row1 = mysql_fetch_row($rs1);
	$row2 = mysql_fetch_row($rs2);
	if(empty($row1) or empty($row2)) {
	    echo "Some errors happened!";	
	} else {
	    $mid = $row1[0];
	    $aid = $row2[0];
	    $query = "select * from movieActor where mid = ".$mid." and aid = ".$aid.";";
	   // echo $query;
	    $rs = mysql_query($query, $db_connection);
	    if(mysql_fetch_row($rs)) {echo "Relation already exists!";} 
	    else {
	        $query = "insert into movieActor values($mid, $aid, \"$role\");";
	        mysql_query($query, $db_connection);
		echo "Relation is added successfully! <br/>";
	    }
	}
    }
}
?>

    <?php mysql_close($db_connection); ?>

    </body>
</html>
