<!-- The Page contains template and functions. -->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Directory</title>
    <link rel="stylesheet" href="./main.css">
</head>

<body>
Input
<ul>
    <li><a href="./addActorDirector.php">Add Actor/Director</a></li>
    <li><a href="./addMovieInfo.php">Add Movie Information</a></li>
    <li><a href="./addComment.php">Add Movie Comment</a></li>
    <li><a href="./addMovieActor.php">Add Movie/Actor Relation</a></li>
    <li><a href="./addMovieDirector.php">Add Movie/Director Relation</a></li>
</ul>
<br>
Browsing
<ul>
    <li><a href="./actorInfo.php">Show Actor Information</a></li>
    <li><a href="./movieInfo.php">Show Movie Information</a></li>
</ul>
<br>
Search
<ul>
    <li><a href="./search.php">Search Actor/Movie</a></li>
</ul>


<?php

// Format Date of Birth and Date of Death
function cleardate($year, $month, $day)
{
    $specify="N/A";
    if ((strpos($year, $specify)!==false) or (strpos($month, $specify)!==false) or (strpos($day, $specify)!==false)) {
        return "null";
    } else {
        if (strlen($month) == 1) {
            $month = '0' . $month;
        }
        if (strlen($day) == 1) {
            $day = '0' . $day;
        }
        return $year . $month . $day;
    }

}

function connect()
{
    $db_connection = mysql_connect("localhost", "root", "root");
    mysql_select_db("movie", $db_connection);
    return $db_connection;
}

?>
</body>

</html>
