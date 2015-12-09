<!-- Page S1: A page that lets users search for an actor/actress/movie through a keyword search interface. (For actor/actress, you should examine first/last name, and for movie, you should examine title.) -->

<!DOCTYPE html>
<html>
<head>
    <title>
        Search Actor/Movie
    </title>
</head>
<body>
<?php
require_once('base.php');
?>
<h3>Search Actor/Movie</h3>
<?php
$db_connection = connect();
?>
<form method="POST" action="<?php
echo $_SERVER['PHP_SELF']; ?>">
    <input type="text" name="search"> <br>
    <input type="submit" value="search">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $_POST["search"];
    if (empty($search)) {
        echo "Please input the name of an actor or a movie";
    } else {

        //search from Movie
        $query1 = "SELECT id FROM Movie WHERE title LIKE \"%" . $search . "%\";";
        echo "<h4>Searching match records in Movie database ...</h4>";
        $rs1 = mysql_query($query1, $db_connection);
        if (mysql_num_rows($rs1) == 0) {
            echo "No such movie record." . "<br>";
        } else {
            $num_movie = 0;
            while ($row1 = mysql_fetch_row($rs1)) {
                $num_movie += 1;
                $mid = $row1[0];
                $query_movie = "SELECT title FROM Movie WHERE id = " . $mid . ";";
                $rs_movie = mysql_query($query_movie, $db_connection);
                $row_movie = mysql_fetch_row($rs_movie);
                echo "<a href=./movieInfo.php?id=" . $mid . ">" . $row_movie[0] . "</a><br>";
            }
            echo "<br>" . "Total movie number: " . $num_movie . "<br><br><br>";
        }

        //search from Actor
        $s = split(" ", $search);
        $num = sizeof($s);
        if ($num == 2) {
            $first = $s[0];
            $last = $s[1];
            $query2 = "SELECT id FROM Actor WHERE first LIKE \"%" . $first . "%\"" . "and last LIKE \"%" . $last . "%\";";
        } elseif ($num == 1) {
            $middle = $s[0];
            $query2 = "SELECT id FROM Actor  WHERE first LIKE \"%" . $middle . "%\"" . "or last LIKE \"%" . $middle . "%\";";
        } else {
            $query2 = "";
        }
        $rs2 = mysql_query($query2, $db_connection);
        echo "<h4>Searching match records in Actor database ...</h4>";
        if (mysql_num_rows($rs2) == 0) {
            echo "No such actor record." . "<br>";
        } else {
            $num_actor = 0;
            while ($row2 = mysql_fetch_row($rs2)) {
                $num_actor += 1;
                $aid = $row2[0];
                $query_actor = "SELECT first, last FROM Actor WHERE id = " . $aid . ";";
                $rs_actor = mysql_query($query_actor, $db_connection);
                $row_actor = mysql_fetch_row($rs_actor);
                echo "<a href=./actorInfo.php?id=" . $aid . ">" . $row_actor[0] . " " . $row_actor[1] . "</a><br>";
            }
            echo "<br>" . "Total actor number: " . $num_actor . "<br>";
        }
    }
}
?>

<?php
mysql_close($db_connection);
?>

</body>
</html>