<!DOCTYPE html>
<html>
    <head>
	<title>
		"Query in movies"
	</title>
    </head>
    <body>
	<h5>"Input your query into the following box"</h5>
	<h5>"Example: select * from actor where id = 10"<h5/>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
 	   Query:<br> 
	   <textarea name="query" rows=5 cols=30></textarea>
  	   <input type="submit">
	</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $query = $_POST['query'];
    if (empty($query)) {
        echo "Query is empty";
    } else {
        echo "Your query: ".$query."<br/>"; 
    }
}
?>
<?php
  $db_connection = mysql_connect("localhost", "root", "root");
  mysql_select_db("movie", $db_connection);
//  $query = "select count(*) from actor";
  $rs = mysql_query($query, $db_connection);
  print "Answer: ";
  while($row = mysql_fetch_row($rs)){
    for($i=0;$i<count($row);$i++){
      $num = $row[$i];
      print "$num ";
    }
  }
  mysql_close($db_connection);
?>
    </body>
</html>
