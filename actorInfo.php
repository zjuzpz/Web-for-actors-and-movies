<!-- Page B1: A page that shows actor information.
Show links to the movies that the actor was in. -->

<!DOCTYPE html>
<html>
<head>
    <title>
        Show Actor Information
    </title>
</head>
<body>
<?php
require_once('base.php');
?>
<h3>Show Actor Information</h3>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $db_connection = connect();
    $id = $_GET["id"];
    if ($id) {

        // Show actor general information
        echo "<h4>Actor info</h4>";
        $query = "SELECT * FROM Actor WHERE id = " . $id . ";";
        $rs = mysql_query($query, $db_connection);
        echo "<table border=2> ";
        $flag = True;
        while ($row = mysql_fetch_row($rs)) {
            if ($flag) {
                echo "<tr>";
                for ($i = 0; $i < sizeof($row); $i++) {
                    echo "<th>" . mysql_field_name($rs, $i) . "</th>";
                }
                echo "</tr>";
                $flag = False;
            }
            echo "<tr>";
            for ($i = 0; $i < sizeof($row); $i++) {
                $temp = ($row[$i] ? $row[$i] : 'N/A');
                echo "<td style='text-align:center'>" . $temp . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";

        // Show links to the movies that the actor was in.
        echo "<h4>Movie he/she acts in</h4>";
        $query = "SELECT mid, role FROM MovieActor WHERE aid = " . $id . ";";
        $rs = mysql_query($query, $db_connection);
        if (mysql_num_rows($rs) == 0) {
            echo "No movie information about this actor can be provided.";
        } else {
            while ($row = mysql_fetch_row($rs)) {
                $query_movie = "SELECT title FROM Movie WHERE id = " . $row[0] . ";";
                $rs_movie = mysql_query($query_movie, $db_connection);
                $row_movie = mysql_fetch_row($rs_movie);
                echo "Act in <a href=./movieInfo.php?id=" . $row[0] . ">" . $row_movie[0] . "</a>";
                echo " as " . "\"" . $row[1] . "\"<br>";
            }
        }
        mysql_close($db_connection);
    } else {
        echo "Please search the actor first." . "<br>";
        echo "<a href=./search.php>" . "Here" . "</a>";
    }
}
?>
</body>
</html>