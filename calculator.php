<!DOCTYPE html>
<html>
<head>
<title>Calculator </title>
</head>
<body>
<h1>Calculator</h1>
<p>Ver 1.0 10/04/2015 by Peizhe Zhang</p>

<form method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?>">
 Expression: <input type = "text" name = "fexpression">
 <input type = "submit">
</form>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $expression = $_REQUEST['fexpression'];
    if(empty($expression)) {
	echo "Expression should not be empty!";
//	exit();
    } else {
	echo "<br>";
	echo "Result: ", "<br>";
	echo myCalculator($expression);
    }
}
function myCalculator($expression) {
$s = str_replace(" ", "", $expression);
echo $s, "=";
$stackOpt = array();
$stackNum = array();
$opt = " */+-";
$tem = "";
$flag1 = true;  //for .
$flag2 = true;  //for -
for($i = 0; $i < strlen($s); $i++) {
    if($i == 0 and $s[$i] == '-') {
	$tem = '-';
	$flag2 =false;
	continue;
    }
    if($flag2 and $s[$i] == '-' and $i != 0 and !is_numeric($s[$i - 1])) {
	$tem = $tem.$s[$i];
	$flag2 = false;
    } else if(is_numeric($s[$i]) or ($flag1 and $s[$i] == '.')) {
        $tem = $tem.$s[$i];
	if($s[$i] == '.') {$flag1 = false;}
//	echo "tem=", $tem, "<br>";
        if($i==strlen($s)-1 or (!is_numeric($s[$i+1]) and $s[$i+1] !='.')) {
            if($tem[strlen($tem) - 1] == '.') {
		echo "Invalid input!";
		exit();
	    }
	    array_push($stackNum, (float)$tem);
	    $tem = ""; $flag1 = true; $flag2 = true;

	    while(count($stackOpt) != 0){
		$tem1 = $stackOpt[count($stackOpt) - 1];
		if($tem1 == '*'or $tem1 == '/'){
		    $num2 = Array_pop($stackNum);
		    $num1 = Array_pop($stackNum);
		    $operator = Array_pop($stackOpt);
		    array_push($stackNum, operation($num1, $operator, $num2));
		} else {
		    break;
		}
	    }

	}
    } else if(strpos($opt, $s[$i])) {
	if($i == 0 or !is_numeric($s[$i - 1])) {
	echo "Invalid input!";
	exit();
    }
        array_push($stackOpt, $s[$i]);
    } else {
        echo "Invalid input!";
	exit();
    }
}
$res = $stackNum[0];
/*
//help debug...
echo "len of opt and num: ",  count($stackOpt), count($stackNum);
echo "first number:", $stackNum[0];
echo "second number: ", $stackNum[1];
echo "operator: ", $stackOpt[0];
echo "<br>", operation($stackNum[0], $stackOpt[0], $stackNum[1]);
*/
for($i = 0; $i<count($stackOpt);$i++){
    $res = operation($res, $stackOpt[$i], $stackNum[$i + 1]);
}

return $res;
}

function operation($num1, $opt, $num2) {
    if($opt == '+') {return $num1 + $num2;}
    if($opt == '-') {return $num1 - $num2;}
    if($opt == '*') {return $num1 * $num2;}
    if($opt == '/') {
	if($num2 == 0) {
	    echo "Division by zero error!";
	    exit();
	}
	return $num1 / $num2;
    }
}

?>

</body>
</html>
