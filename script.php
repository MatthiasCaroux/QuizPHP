<h1>Bonjour</h1>
<?php
echo '<h1>Salut</h1>';

$var = "toto";
echo '<h1>'.$var.'</h1>';
echo $var;

$var = 4;
echo '<h1>'.$var.'</h1>';
echo $var;

$var = [1, 2, 3];
echo '<h1>'.$var.'</h1>';
echo "<h1>$var</h1>";
echo "<h3>Contenu de la liste : </h3>";

for ($i = 0; $i < count($var); $i++) {
    echo "<p>$var[$i]</p>";
}

$var = "'5.'";
echo '<h1>'.$var.'</h1>';
echo "<h1>$var</h1>";
echo $var;

$string = 'simple string'; // type string
$integer = 12345;
$float = 23.5;
$boolean = true; 

// Complex dataType
$array = ['item1', 'item2'];
$null = null;
// $request = new Request();

// Function
function addInteger(int $number1, int $number2): int
{
    return $number1 + $number2; 
}

$res = addInteger(14, 2);
echo "<h1>14 + 2 = $res</h1>";

echo "<h1>Calcul : </h1>";
$x = 10;
$y = 5;

// print_r($test);
$quest = array();
$test = array();
array_push($test, $x + $y);
array_push($quest, "$x + $y");

array_push($test, $x - $y);
array_push($quest, "$x - $y");

array_push($test, $x * $y);
array_push($quest, "$x * $y");

array_push($test, $x ** $y); // expo
array_push($quest, "$x ** $y");

array_push($test, $x % $y); // modulus
array_push($quest, "$x % $y");

array_push($test, $x / $y);
array_push($quest, "$x / $y");


// $test[] = $x + $y;
// $test[] = $x - $y;
// $test[] = $x * $y;
// $test[] = $x ** $y; // expo
// $test[] = $x % $y; // modulus
// $test[] = $x / $y;

for ($i = 0; $i < count($test); $i++) {
    echo "<p>$quest[$i] = $test[$i]</p>";
}

echo "<h1>Comparaison : </h1>";

$x = 10;
$y = 5;

$is_equal = $x == $y;
$is_not_equal = $x != $y;
$is_greater = $x > $y;
$is_less = $x < $y;
$is_greater_or_equal = $x >= $y;
$is_less_or_equal = $x <= $y;

$quest = array();
$test = array();

array_push($test, $is_equal);
array_push($quest, "$x == $y");

array_push($test, $is_not_equal);
array_push($quest, "$x != $y");

array_push($test, $is_greater);
array_push($quest, "$x > $y");

array_push($test, $is_less);
array_push($quest, "$x < $y");

array_push($test, $is_greater_or_equal);
array_push($quest, "$x >= $y");

array_push($test, $is_less_or_equal);
array_push($quest, "$x <= $y");

for ($i = 0; $i < count($test); $i++) {
    $rep = 0;
    if ($test[$i] == 1) {
        $rep = "True";
    } else {
        $rep = "False";
    }
    echo "<p>$quest[$i] = $rep</p>";
}

echo "<h1>Pair - Impair : </h1>";

for ($i = 0; $i < 10; $i++) {
    echo "the number is $i and it's ";
    if ($i % 2 == 0) {
        echo "pair.<br>";
    } else {
        echo "impair.<br>";
    }

}

$fruits = array("apple" => "red", "banana" => "yellow", "cherry" => "red");
echo "<h1>Les fruits : </h1>";
foreach ($fruits as $key => $value) {
    echo "<p>Le fruit est $key et sa couleur est $value</p>";
}

print_r($fruits);
?>