<!-- <?php
// declare(strict_types=1);
class Test {
    public $value;
}

$myclass = new Test();
$myclass->value = "my fake value";
// echo $myclass; // error
echo $myclass->value;

echo "<br>";

$myclass->value = "my new value";
echo $myclass->value;

echo "<br>";

$myclass->value = 14;
echo $myclass->value;

echo "<br>";
?> -->

<!-- <?php
class MyClass {
    public $value;

    public function isValueAnInteger()
    {
        return is_int($this->value);
    }

    public function square()
    {
        return $this->value * $this->value;
    }
}

$myClass = new MyClass();

$myClass->value = 2;
echo $myClass->isValueAnInteger().PHP_EOL; // true
echo $myClass->square().PHP_EOL; // 4

echo "<br>";

$myClass->value = 'top';
echo $myClass->isValueAnInteger().PHP_EOL; // false // ne s'affiche pas
// echo $myClass->square().PHP_EOL; // 0 // error // ne s'affiche pas

echo "<br>";

$myClass->value = 5;
echo $myClass->isValueAnInteger().PHP_EOL; // true
echo $myClass->square().PHP_EOL; // 0

echo "<br>";
?> -->

<!-- <?php
$dt = new DateTime(); // Instanciation de la Class datetime - Default current timestamp

echo $dt->format('Y-m-d').PHP_EOL;

echo "<br>";

$dt->add(new DateInterval('P10D')); // Ajout de 10 jours
echo $dt->format('Y-m-d').PHP_EOL;

echo "<br>";
?> -->

<?php
class Service {

    private $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function getData()
    {
        if(!$this->isValid())
        {
            trigger_error('Not an URL', E_USER_ERROR);
        }
        return file_get_contents($this->url);
    }

    private function isValid()
    {
        return preg_match('/^https?:\/\/(?:www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b(?:[-a-zA-Z0-9()@:%_\+.~#?&\/=]*)$/', $this->url);
    }
}

$service = new Service('https://www.youtube.com');
// echo $service->getData().PHP_EOL;

echo "<br>";
?>

<?php
class Service2 {
    private static $url = 'https://jsonplaceholder.typicode.com/todos/1';

    public static function url(): string
    {
        return self::$url;
    }
}

echo Service2::url(); // https://jsonplaceholder.typicode.com/todos/1

echo "<br>";

$test = new Service('https://jsonplaceholder.typicode.com/todos/1');
echo $test->getData();

echo "<br>";
?>