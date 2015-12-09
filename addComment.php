<!-- Page I3: A page that lets users to add comments to movies. -->

<!DOCTYPE html>
<html>
<head>
    <title>
        Add Movie Comment
    </title>
</head>
<body>
<?php
require_once('base.php');
?>
<h3>Add Movie Comment</h3>
<?php
$db_connection = connect();
$movie_id = $_GET["id"];
if ($movie_id) {
    $query = "SELECT title FROM Movie WHERE id=\"" . $movie_id . "\";";
} else {
    $query = "SELECT title FROM Movie;";
}
$rs = mysql_query($query, $db_connection);
?>

<form method="POST" action="<?php
echo $_SERVER['PHP_SELF']; ?>">
    Your name<span class="required">*</span>: <input type="text" name="reviewer" placeholder="Mr. Anonymous"><br>
    Title
    <?php
    echo '<select name="title">';
    while ($row = mysql_fetch_row($rs)) {
        echo "<option>" . $row[0] . "</option>";
    }
    echo '</select>' . '<br>';
    ?>
    Rating<select name="rating">
        <option value="1">1 - I hate it</option>
        <option value="2">2 - Not worth</option>
        <option value="3">3 - It's ok</option>
        <option value="4">4 - good</option>
        <option value="5">5 - excellent</option>
    </select>
    <br>
    Comment<span class="required">*</span>:<br>
    <textarea name="comment" cols=40 rows=7></textarea><br>
    <input type="submit" name="add" value="Add"><br>
</form>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reviewer = $_POST["reviewer"];
    $title = $_POST["title"];
    $rating = $_POST["rating"];
    $comment = $_POST["comment"];
    if (empty($reviewer) or empty($comment)) {
        echo "*: required information!";
    } else {
        $query = "SELECT * FROM Movie WHERE title = \"" . $title . "\";";
        $rs = mysql_query($query, $db_connection);
        if (mysql_num_rows($rs) == 0) {
            echo "There is no such movie, please enter a vaild movie name." . "<br>";
        } else {
            $row = mysql_fetch_row($rs);
            $mid = $row[0];
            $query = "INSERT INTO Review VALUES(\"$reviewer\", current_timestamp, $mid,\"$rating\",\"$comment\");";
            mysql_query($query, $db_connection);
            echo "Add comment to the movie is successful!" . "<br>";
        }
    }
}
?>

<?php
mysql_close($db_connection);
?>
</body>
</html>