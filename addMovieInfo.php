<!--Page I2: A page that lets users to add movie information.-->

<!DOCTYPE html>
<html>
<head>
    <title>
        Add Movie Information
    </title>
</head>
<body>
<?php
require_once('base.php');
?>
<h3>Add Movie Information</h3>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    Title<span class=required>*</span>: <input type="text" name="title"><br>
    Company<span class=required>*</span>: <input type="text" name="company"><br>
    Year<span class=required>*</span>
    <?php
    echo '<select name="year">';
    for ($i = 1800; $i <= 2100; $i++) {
        echo "<option>" . $i . "</option>";
    }
    echo '</select>' . '<br>';
    ?>

    MPAA Rating<span class="required">*</span> <select name="rating">
        <option value="G">G</option>
        <option value="NC-17">NC-17</option>
        <option value="PG">PG</option>
        <option value="PG-13">PG-13</option>
        <option value="R">R</option>
        <option value="surrendere">surrendere</option>
    </select>
    <br>
    Genre<span class="required">*</span>
    <select name="genre">
        <option value="Action">Action</option>
        <option value="Adult">Adult</option>
        <option value="Adventure">Adventure</option>
        <option value="Animation">Animation</option>
        <option value="Comedy">Comedy</option>
        <option value="Crime">Crime</option>
        <option value="Documentary">Documentary</option>
        <option value="Drama">Drama</option>
        <option value="Family">Family</option>
        <option value="Fantasy">Fantasy</option>
        <option value="Horror">Horror</option>
        <option value="Musical">Musical</option>
        <option value="Mystery">Mystery</option>
        <option value="Romance">Romance</option>
        <option value="Sci-Fi">Sci-Fi</option>
        <option value="Short">Short</option>
        <option value="Thriller">Thriller</option>
        <option value="War">War</option>
        <option value="Western">Western</option>
    </select>
    <br>
    <input type="submit" value="Add">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $company = $_POST["company"];
    $year = $_POST["year"];
    $rating = $_POST["rating"];
    $genre = $_POST["genre"];
    if (empty($title) or empty($company) or empty($year)) {
        echo " *: required information!";
    } else {
        $db_connection = connect();

        //incease max movie ID
        $query = "SELECT id FROM MaxMovieID;";
        $rs = mysql_query($query, $db_connection);
        $row = mysql_fetch_row($rs);
        $maxID = $row[0] + 1;
        $query = "UPDATE MaxMovieID SET id = " . $maxID . ";";
        mysql_query($query, $db_connection);

        //update Movie table
        $query = "INSERT INTO Movie VALUES($maxID, \"$title\", $year, \"$rating\",\"$company\");";
        mysql_query($query, $db_connection);

        //update MovieGenre table
        for ($i = 0; $i < count($genre); $i++) {
            $query = "INSERT INTO MovieGenre VALUES($maxID, \"$genre[$i]\");";
            mysql_query($query, $db_connection);
        }
        mysql_close($db_connection);
        echo $title . " is added successfully!" . "<br/>";
    }
}
?>

</body>
</html>