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
		"Add movie"
	</title>
    </head>
    <body>
	<h3>Add a new movie </h3>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"> 
	   <style>.required {color:#ff0000;} </style>
	   Title: <input type="text" name="title" style="font-size:18px;width:150px;"> <span class=required>*</span> </br>
	   Company: <input type="text" name="company" style="font-size:18px;width:150px;"> <span class=required>*</span> </br>
	   Year <input type="number" name="year" min="1800" max="2100" style="width:100px;"><span class=required>*</span></br>
	   MPAA Rating <select name="rating"> 
			  <option>G</option>
			  <option>NC-17</option>
			  <option>PG</option>
			  <option>PG-13</option>
			  <option>R</option>
		       </select> </br>
	   Genre <input type="checkbox" name="genre[]" value="Action"> Action
	   	 <input type="checkbox" name="genre[]" value="Adult"> Adult
	   	 <input type="checkbox" name="genre[]" value="Adventure"> Adventure
	   	 <input type="checkbox" name="genre[]" value="Animation"> Animation
	   	 <input type="checkbox" name="genre[]" value="Comedy"> Comedy
	   	 <input type="checkbox" name="genre[]" value="Crime"> Crime </br>
	   	 <input type="checkbox" name="genre[]" value="Documentary"> Documentary
	   	 <input type="checkbox" name="genre[]" value="Drama"> Drama
	   	 <input type="checkbox" name="genre[]" value="Family"> Family
	   	 <input type="checkbox" name="genre[]" value="Fantasy"> Fantasy
	   	 <input type="checkbox" name="genre[]" value="Horror"> Horror
	   	 <input type="checkbox" name="genre[]" value="Musical"> Musical
	   	 <input type="checkbox" name="genre[]" value="Mystery"> Mystery </br>
	   	 <input type="checkbox" name="genre[]" value="Romance"> Romance
	   	 <input type="checkbox" name="genre[]" value="Sci-Fi"> Sci-Fi
	   	 <input type="checkbox" name="genre[]" value="Short"> Short
	   	 <input type="checkbox" name="genre[]" value="Thriller"> Thriller
	   	 <input type="checkbox" name="genre[]" value="War"> War
	   	 <input type="checkbox" name="genre[]" value="Western"> Western <span class="required">*</span></br>
  	   <input type="submit" value="Add!">
	</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $title = $_POST["title"];
    $company = $_POST["company"];
    $year = $_POST["year"];
    $rating = $_POST["rating"];
    $genre = $_POST["genre"];
    if (empty($title) or empty($company) or empty($year) or empty($rating) or empty($genre)) {
        echo " *: required information!";
    } else {
        echo $title." is added successfully!"."<br/>"; 
 	$db_connection = mysql_connect("localhost", "root", "root");
 	mysql_select_db("movie", $db_connection);
//incease max movie ID
  	$query = "select id from maxMovieID;";
  	$rs = mysql_query($query, $db_connection);
  	$row = mysql_fetch_row($rs);
  	$maxID = $row[0] + 1;
  	$query = "update maxMovieID set id =".$maxID.";";
//	echo $query."</br>";
  	mysql_query($query, $db_connection);
//update moive table
        $query = "insert into movie values($maxID, \"$title\", $year, \"$rating\",\"$company\");";
//  	echo $query."</br>";
	mysql_query($query, $db_connection);
//update movieGenre table
	for($i=0;$i<count($genre);$i++) {
	$query = "insert into movieGenre values($maxID, \"$genre[$i]\");";
//	print $query."</br>";
	mysql_query($query, $db_connection);
	}
        mysql_close($db_connection);
    }
}
?>

    </body>
</html>
