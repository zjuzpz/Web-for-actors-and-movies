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
		"Query in movies"
	</title>
    </head>
    <body>
	<h3>Add a new actor or director </h3>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"> 
	   <style>.required {color:#ff0000;} </style>
	   <input type="radio" name="add_type" value="actor"> actor
	   <input type="radio" name="add_type" value="director"> director <span class=required>*</span></br>
	   First Name: <input type="text" name="first_name" style="font-size:18px;width:150px;"> <span class=required>*</span> </br>
	   Last Name: <input type="text" name="last_name" style="font-size:18px;width:150px;"> <span class=required>*</span></br>
	   Gender: <input type="radio" name="gender" value="male"> male
		   <input type="radio" name="gender" value="female"> female <span class=required>*</span> </br>
	   Date of birth: year <input type="number" name="byear" min="1800" max="2100" style="width:100px;">
		          month <input type="number" name="bmonth" min="1" max="12" style="width:50px;">
		          day <input type="number" name="bday" min="1" max="31" style="width:50px;"><span class=required>*</span></br>
	   Date of death: year <input type="number" name="dyear" min="1800" max="2100" style="width:100px;">
		          month <input type="number" name="dmonth" min="1" max="12" style="width:50px;">
		          day <input type="number" name="dday" min="1" max="31" style="width:50px;"></br>
  	   <input type="submit" value="Add!">
	</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $add_type = $_POST["add_type"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $gender = $_POST["gender"];
    $byear = $_POST["byear"];
    $bmonth = $_POST["bmonth"];
    $bday = $_POST["bday"];
    $dyear = $_POST["dyear"];
    $dmonth = $_POST["dyear"];
    $dday = $_POST["dday"];
    if (empty($add_type) or empty($first_name) or empty($last_name) or empty($gender) or empty($byear) or empty($bmonth) or empty($bday)) {
        echo " *: required information!";
    } else {
        echo $add_type.": ".$first_name." ".$last_name." is added successfully!"."<br/>"; 
	$birth = $byear.$bmonth.$bday;
	$death = $dyear.$dmonth.$dday;
	if(empty($death)) {$death = "null";}
 	$db_connection = mysql_connect("localhost", "root", "root");
 	mysql_select_db("movie", $db_connection);
//incease max person ID
  	$query = "select id from maxPersonID;";
  	$rs = mysql_query($query, $db_connection);
  	$row = mysql_fetch_row($rs);
  	$maxID = $row[0] + 1;
  	$query = "update maxPersonID set id =".$maxID.";";
  	mysql_query($query, $db_connection);
//update actor or director
  	if($add_type == "actor") {
      	    $query = "insert into actor values($maxID, \"$last_name\", \"$first_name\", \"$gender\", $birth, $death);";
  	} else {
      	    $query = "insert into director values($maxID, \"$last_name\", \"$first_name\", $birth, $death);";
  	}
echo $query;
  	mysql_query($query, $db_connection);
        mysql_close($db_connection);
    }
}
?>

    </body>
</html>
