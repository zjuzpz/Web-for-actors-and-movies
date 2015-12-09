<!--Page I5: A page that lets users to add "director to movie" relation(s).-->

<!DOCTYPE html>
<html>
<head>
    <title>
        Add Movie/Director Relation
    </title>
</head>
<body>
<?php
require_once('base.php');
?>
<h3>Add Movie/Director Relation</h3>
<?php
$db_connection = connect();
$query1 = "SELECT title FROM Movie;";
$rs1 = mysql_query($query1, $db_connection);
$query2 = "SELECT first, last FROM Director;";
$rs2 = mysql_query($query2, $db_connection);
?>
<form method="POST" action="<?php
echo $_SERVER['PHP_SELF']; ?>">
    Title
    <?php
    echo '<select name="title">';
    while ($row = mysql_fetch_row($rs1)) {
        echo "<option>" . $row[0] . "</option>";
    }
    echo '</select>' . '<br>';
    ?>

    Director
    <?php
    echo '<select name="director">';
    while ($row = mysql_fetch_row($rs2)) {
        echo "<option>" . "$row[0]" . " " . "$row[1]" . "</option>";
    }
    echo '</select>' . '<br>';
    ?>
    <input type="submit" value="add relation!">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $director = $_POST["director"];
    $s = split(" ", $director);
    $first = $s[0];
    $last = $s[1];
    $query1 = "SELECT id FROM Movie WHERE title = \"" . $title . "\";";
    $query2 = "SELECT id FROM Director WHERE first = \"" . $first . "\" and last = \"" . $last . "\";";
    $rs1 = mysql_query($query1, $db_connection);
    $rs2 = mysql_query($query2, $db_connection);
    $row1 = mysql_fetch_row($rs1);
    $row2 = mysql_fetch_row($rs2);
    $mid = $row1[0];
    $did = $row2[0];
    $query = "SELECT * FROM MovieDirector WHERE mid = " . $mid . " and did = " . $did . ";";
    $rs = mysql_query($query, $db_connection);
    if (mysql_num_rows($rs) != 0) {
        echo "Relation already exists! Please choose another movie or director to add.";
    } else {
        $query = "INSERT into MovieDirector VALUES($mid, $did);";
        mysql_query($query, $db_connection);
        echo "Relation is added successfully! <br/>";
    }
}
?>

<?php
mysql_close($db_connection); ?>

</body>
</html>