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
		"Add comments"
	</title>
    </head>
    <body>
	<h3>Add comments </h3>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"> 
	    <style>.required {color:#ff0000;} </style>
	    Review name: <input type="text" name="reviewer" style="font-size:18px;width:350px;"> <span class="required">*</span></br>
	    Title: <input type="text" name="title" style="font-size:18px;width:350px;"><span class="required">*</span>  </br>
	    Rating <input type="number" name="rating" min="1" max="5" style="width:100px;"><span class="required">*</span> (5 is most satisfied) </br>
	    Comments:</br> <textarea name="comment"style="font-size:18px;" rows=10 cols=50></textarea> <span class="required">*</span></br>
	    <input type="submit" name="add" value="Add!"></br>
	</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $movie_exist = False;
    $reviewer = $_POST["reviewer"];
    $title = $_POST["title"];
    $rating = $_POST["rating"];
    $comment = $_POST["comment"];
    if (empty($reviewer) or empty($title) or empty($rating) or empty($comment)) {
        echo "*: required information!";
    } else {
        $db_connection = mysql_connect("localhost", "root", "root");
	mysql_select_db("movie", $db_connection);
	$query = "select * from movie where title = \"".$title."\";";
	$rs = mysql_query($query, $db_connection);
	print "<table border=3> ";
	$len = mysql_num_fields($rs);
	print "<tr>";
	for($i=0;$i<$len;$i++){
	    print "<td style='text-align:center'>".mysql_field_name($rs,$i)."</td>";
	 }
	print "</tr>";
	while($row = mysql_fetch_row($rs)){
	    if(!$movie_exist) {$movie_exist = True;}
	print "<tr>";
	    for($i=0;$i<count($row);$i++){
		if($i==0) {$mid=$row[$i];}
	        $val = $row[$i];
	        if($val){
                    print "<td>"."$val "."</td>";
		} else {print "<td>N/A</td>";}  				
	    } 
	    print "</tr>";
	}
	if(!$movie_exist) {print $title." is not found!";}
	else {print "Add comments to the following movie is successfully!";
	    $query = "insert into review values(\"$reviewer\", current_timestamp, $mid,\"$rating\",\"$comment\");";
	    mysql_query($query, $db_connection);
	}
	print "</table>";
        mysql_close($db_connection);
    }
}
?>
    </body>
</html>
