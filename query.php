<!DOCTYPE html>
<html>
    <head>
	<title>
		"Query in movies"
	</title>
    </head>
    <body>
	<h3>Input your query into the following box</h3>
	<h3>Example: select * from actor where id = 10<h3/>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
 	   Query:<br> 
	   <textarea style="font-size:18px" name="query" rows=5 cols=50></textarea>
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
  print "Answer:<br/> ";
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

  mysql_close($db_connection);
?>
     <h3>available tables: </h3>
     <ul>
     <li>actor</li>           
     <li>director</li>        
     <li>maxMovieID</li>      
     <li>maxPersonID</li>
     <li>movie </li>
     <li>movieActor</li>
     <li>movieDirector</li>
     <li>movieGenre</li>
     <li>review</li>   
     </ul>
    </body>
</html>
