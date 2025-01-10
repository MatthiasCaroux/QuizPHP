<?php

require_once('Question.php');

class RadioQuestions extends Question {
    private $choices;
    private $correctAnswer;

    public function __construct($uuid, $label, $choices, $correctAnswer) {
        parent::__construct($uuid, $label);
        $this->choices = $choices;
        $this->correctAnswer = $correctAnswer;
    }

    public function display() {
        echo "<div class='question'>";
        echo "<h2>{$this->getLabel()}</h2>";
        echo "<ul>";
        foreach ($this->choices as $choice) {
            echo "<li><input type='radio' name='{$this->getLabel()}' value='$choice'>$choice</li>";
        }
        echo "</ul>";
        echo "</div>";
    }

    public function getCorrectAnswer() {
        return $this->correctAnswer;
    }
}

?>