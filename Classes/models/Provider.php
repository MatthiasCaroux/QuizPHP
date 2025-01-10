<?php

namespace models;

require_once "Classes/models/Questions_simple.php";

use models\Questions_simple;

class Provider{

    private $lesQuestions;


    public function __construct(){
        $json = file_get_contents("https://geoffroycochard.github.io/iuto.but2.php/resources/data/model.json");
        $json = json_decode($json,associative: true);
        $questions = array();
        foreach($json as $question){
            if ($question["type"] == "radio"){
                array_push($questions,new Questions_simple($question["uuid"],$question["label"],$question["choices"],$question["correct"]));
            }
        }
        $this->lesQuestions = $questions;
    }


    public function getQuestions(){
        return $this->lesQuestions;
    }
}
