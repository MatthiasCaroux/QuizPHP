<?php

// use Classes\Autoloader;

require 'Classes/Autoloader.php';
Autoloader::register();

// require 'Classes/Autoloader.php';
// use Classes\Autoloader;
// $autoloader = new Autoloader();
// $autoloader->register();

use Form\Type\Text;
use Form\Type\Hidden;
use Form\Type\Textarea;
use Form\Type\Checkbox;
use Form\Type\Input;

$threadMessage = new \Thread\Message;
$messengerMessage = new \Messenger\Message;

// ou avec le keyword use
// use Thread\Message;
// $threadMessage = new Message;

// use Messenger\Message;
// $messengerMessage = new Message;

// ou en aliassant
use Thread\Message as TheadMessage;
use Messenger\Message as MessengerMessage;

$threadMessage = new TheadMessage;
$messengerMessage = new MessengerMessage;

// require 'Classes/Autoloader.php';

// $autoloader = new Autoloader();

/*$form = [
    [
        'type' => 'text',
        'name' => 'mytext',
        'required' => false,
    ],
    [
        'type' => 'hidden',
        'name' => 'hiddenfield',
        'required' => false,
    ],
    [
        'type' => 'textarea',
        'name' => 'mytextarea',
        'required' => true,
    ],
    [
        'type' => 'checkbox',
        'name' => 'mycheckbox',
        'required' => false,
    ],
];

foreach($form as $field) {
    echo $field['type'].PHP_EOL;
    // $className = ucfirst($field['type']);
    $className = 'Form\Type\\' . $field['type'];
    echo new $className($field['name'], $field['required']).PHP_EOL;
}
die();
*/

$text = new Text('myinput', false, 'coucou');
echo $text->render().PHP_EOL;
echo "<br>";

$checkbox = new Checkbox('mycheckbox', true);
echo $checkbox->render().PHP_EOL;
echo "<br>";

$hidden = new Hidden('myhidden');
echo $hidden->render().PHP_EOL;
echo "<br>";

echo new Text('mytexttostring').PHP_EOL;
echo "<br>";

echo new Textarea('mytextarea', true, 'default value').PHP_EOL;

?>