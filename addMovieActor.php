<!--Page I4: A page that lets users to add "actor to movie" relation(s).-->

<!DOCTYPE html>
<html>
<head>
    <title>
        Add Movie/Actor Relation
    </title>
</head>
<body>
<?php
require_once('base.php');
?>
<h3>Add Movie/Actor Relation</h3>
<?php
$db_connection = connect();
$query1 = "SELECT title FROM Movie;";
$rs1 = mysql_query($query1, $db_connection);
$query2 = "SELECT first, last FROM Actor;";
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

    Actor
    <?php
    echo '<select name="actor">';
    while ($row = mysql_fetch_row($rs2)) {
        echo "<option>" . "$row[0]" . " " . "$row[1]" . "</option>";
    }
    echo '</select>' . '<br>';
    ?>

    Role<span class="required">*</span> <input type="text" name="role"> </br>
    <input type="submit" value="add relation!">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $actor = $_POST["actor"];
    $role = $_POST["role"];
    if (empty($role)) {
        echo "*: required information!";
    } else {
        $s = split(" ", $actor);
        $first = $s[0];
        $last = $s[1];
        $query1 = "SELECT id FROM Movie WHERE title = \"" . $title . "\";";
        $query2 = "SELECT id FROM Actor WHERE first = \"" . $first . "\" and last = \"" . $last . "\";";
        $rs1 = mysql_query($query1, $db_connection);
        $rs2 = mysql_query($query2, $db_connection);
        $row1 = mysql_fetch_row($rs1);
        $row2 = mysql_fetch_row($rs2);
        $mid = $row1[0];
        $aid = $row2[0];
        $query = "SELECT * FROM MovieActor WHERE mid = " . $mid . " and aid = " . $aid . ";";
        $rs = mysql_query($query, $db_connection);
        if (mysql_num_rows($rs) != 0) {
            echo "Relation already exists! Please choose another movie or actor to add.";
        } else {
            $query = "INSERT INTO MovieActor VALUES($mid, $aid, \"$role\");";
            mysql_query($query, $db_connection);
            echo "Relation is added successfully! <br/>";
        }
        mysql_close($db_connection);
    }
}
?>
<?php
mysql_close($db_connection); ?>
</body>
</html>