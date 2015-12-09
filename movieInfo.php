<!-- Page B2: A page that shows movie information.
Show links to the actors/actresses that were in this movie.
Show the average score of the movie based on user feedbacks.
Show all user comments.
Contain "Add Comment" button which links to Page I3 where users can add comments. -->

<!DOCTYPE html>
<html>
<head>
    <title>
        Show Movie Information
    </title>
</head>
<body>
<?php
require_once('base.php');
?>
<h3>Show Movie Information</h3>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $db_connection = connect();
    $id = $_GET["id"];
    if ($id) {

        // Show movie general information
        echo "<h4>Movie info</h4>";
        $query = "SELECT * FROM Movie WHERE id = " . $id . ";";
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
        echo "<br><br>";

        // Show movie genre
        $query = "SELECT genre FROM MovieGenre WHERE mid = " . $id . ";";
        $rs = mysql_query($query, $db_connection);
        if (mysql_num_rows($rs) != 0) {
            $row = mysql_fetch_row($rs);
            echo "<h4>Movie Genre</h4>";
            echo $row[0] . "<br>";
        }

        // Show links to the actors/actresses that were in this movie.
        echo "<h4>Actors in this movie</h4>";
        $query = "SELECT aid, role FROM MovieActor WHERE mid = " . $id . ";";
        $rs = mysql_query($query, $db_connection);
        if (mysql_num_rows($rs) == 0) {
            echo "No actor information about this movie can be provided.";
        } else {

            while ($row = mysql_fetch_row($rs)) {
                $query_actor = "SELECT first, last FROM Actor WHERE id = " . $row[0] . ";";
                $rs_actor = mysql_query($query_actor, $db_connection);
                if (mysql_num_rows($rs_actor) != 0) {
                    $row_actor = mysql_fetch_row($rs_actor);
                    echo "<a href=actorInfo.php?id=" . $row[0] . ">" . $row_actor[0] . " " . $row_actor[1] . "</a>";
                    echo " act as" . "\"" . $row[1] . "\"<br>";
                }
            }
        }

        // Show all user comments and average rating score.
        echo "<h4>User Review</h4>";
        $query = "SELECT name, time, rating, comment FROM Review WHERE mid = " . $id . ";";
        $rs = mysql_query($query, $db_connection);
        if (mysql_num_rows($rs) == 0) {
            echo "There is no review available on this movie." . "<br>";
        } else {
            $total_score = 0;
            $total_review = 0;
            while ($row = mysql_fetch_row($rs)) {
                echo "Reviewer: " . $row[0] . "<br>";
                echo "Time: " . $row[1] . "<br>";
                echo "Rating: " . $row[2] . "<br>";
                echo "Comments: " . $row[3] . "<br><br>";
                $total_score += $row[2];
                $total_review += 1;
            }
            $avg_score = number_format($total_score / $total_review, 2);
            echo "The average score of rating from " . $total_review . "reviews is " . $avg_score . ".";
        }
        echo "<a href=addComment.php?id=" . $id . ">" . "Add new comment!" . "</a>";
        mysql_close($db_connection);
    } else {
        echo "Please search the movie first." . "<br>";
        echo "<a href=./search.php>" . "Here" . "</a>";
    }
}
?>
</body>
</html>