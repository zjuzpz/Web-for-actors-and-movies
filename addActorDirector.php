<!-- Page I1: A page that lets users to add actor and/or director information. e.g. Here are some "reasonable" names: Chu-Cheng Hsieh, J'son Lee, etc. -->

<!DOCTYPE html>
<html>
<head>
    <title>
        Add Actor/Director
    </title>
</head>
<body>
<?php
require_once('base.php');
?>
<h3>Add Actor/Director</h3>

<form method="POST" action="<?php
echo $_SERVER['PHP_SELF']; ?>">
    Indentity<span class=required>*</span>: <input type="radio" name="add_type" value="actor">Actor
    <input type="radio" name="add_type" value="director">Director<br>
    First Name<span class=required>*</span>: <input type="text" name="first_name"><br>
    Last Name<span class=required>*</span>: <input type="text" name="last_name"><br>
    Gender<span class=required>*</span>: <input type="radio" name="gender" value="male">Male
    <input type="radio" name="gender" value="female">Female<br>
    Date of Birth<span class=required>*</span>:
    Year
    <?php
    echo '<select name="byear">';
    for ($i = 1800; $i <= 2100; $i++) {
        echo "<option>" . $i . "</option>";
    }
    echo '</select>' . ' ';
    ?>
    Month
    <?php
    echo '<select name="bmonth">';
    for ($i = 1; $i <= 12; $i++) {
        echo "<option>" . $i . "</option>";
    }
    echo '</select>' . ' ';
    ?>
    Day
    <?php
    echo '<select name="bday">';
    for ($i = 1; $i <= 31; $i++) {
        echo "<option>" . $i . "</option>";
    }
    echo '</select>' . '<br>';
    ?>

    Date of Death:
    Year
    <?php
    echo '<select name="dyear">';
    echo "<option>" . "N/A" . "</option>";
    for ($i = 1800; $i <= 2100; $i++) {
        echo "<option>" . $i . "</option>";
    }
    echo '</select>' . ' ';
    ?>
    Month
    <?php
    echo '<select name="dmonth">';
    echo "<option>" . "N/A" . "</option>";
    for ($i = 1; $i <= 12; $i++) {
        echo "<option>" . $i . "</option>";
    }
    echo '</select>' . ' ';
    ?>
    Day
    <?php
    echo '<select name="dday">';
    echo "<option>" . "N/A" . "</option>";
    for ($i = 1; $i <= 31; $i++) {
        echo "<option>" . $i . "</option>";
    }
    echo '</select>' . '<br>';
    ?>

    <input type="submit" value="Add">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $add_type = $_POST["add_type"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $gender = $_POST["gender"];
    $byear = $_POST["byear"];
    $bmonth = $_POST["bmonth"];
    $bday = $_POST["bday"];
    $dyear = $_POST["dyear"];
    $dmonth = $_POST["dmonth"];
    $dday = $_POST["dday"];
    if (empty($add_type) or empty($first_name) or empty($last_name) or empty($gender)) {
        echo " *: required information!";
    } else {
        $birth = cleardate($byear, $bmonth, $bday);
        $death = cleardate($dyear, $dmonth, $dday);
        $db_connection = connect();

        //incease max person ID
        $query = "SELECT id FROM MaxPersonID;";
        $rs = mysql_query($query, $db_connection);
        $row = mysql_fetch_row($rs);
        $maxID = $row[0] + 1;
        $query = "UPDATE MaxPersonID SET id =" . $maxID . ";";
        mysql_query($query, $db_connection);

        //update actor or director
        if ($add_type == "actor") {
            $query = "INSERT INTO Actor VALUES($maxID, \"$last_name\", \"$first_name\", \"$gender\", $birth, $death);";
        } else {
            $query = "INSERT INTO Director VALUES($maxID, \"$last_name\", \"$first_name\", $birth, $death);";
        }
        mysql_query($query, $db_connection);
        mysql_close($db_connection);
        echo $add_type . ": " . $first_name . " " . $last_name . " is added successfully!" . "<br/>";
    }
}
?>

</body>
</html>