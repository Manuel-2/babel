<?php

class LearingPathController
{

  public function create()
  {
    // TODO: guardar en una session un timestap con la ultima vez que se genero un plan de estudio y limita el rate

    $lenguage = $_POST["language"];
    $objective = $_POST["objective"];
    $level = $_POST["level"];

    $learningPathTemplate = file_get_contents('../learingPathTemplate.json');
    $promnt = json_decode(file_get_contents('../iaMessageTemplate.json'));

    $message = $promnt->messages[0]->content;
    $message = str_replace('%lenguage%', $lenguage, $message);
    $message = str_replace('%objective%', $objective, $message);
    $message = str_replace('%level%', $level, $message);
    $promnt->messages[0]->content = $message . $learningPathTemplate;


    $options = [
      'http' => [
        'method'  => 'POST',
        'header'  => 'Content-type: application/json',
        'content' => json_encode($promnt),
      ],
    ];
    $context  = stream_context_create($options);
    $iaResponse = file_get_contents('http://localhost:11434/api/chat', false, $context);

    $generatedlearingPath = json_decode($iaResponse);
    $generatedlearingPath = $generatedlearingPath->message->content;
    $generatedlearingPath = json_decode($generatedlearingPath);

 
  }

  public function show() {}
}
