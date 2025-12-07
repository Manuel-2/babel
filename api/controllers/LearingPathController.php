<?php
require(__DIR__ . '/../models/LearningPath.php');

class LearingPathController
{

  public function create()
  {
    // TODO: guardar en una session un timestap con la ultima vez que se genero un plan de estudio y limita el rate de llamados a este metodo

    //TODO: CUrar las entradas esto estA PELIGROSOOOOOOO
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

    $learingPath = new LearningPath($lenguage, $level, $objective, $generatedlearingPath->modules);
    try {
      $learingPath->save();
    } catch (PDOException $e) {
      $GLOBALS['serverError']($e);
    }

    $_SESSION['hasLearningPath'] = true;
    return new Response(201, [
      'message' => "Plan de estudios generado correctamente"
    ]);
  }

  public function show()
  {
    $userId = $_SESSION['userId'];
    $learningPath = LearningPath::findByUserId($userId);

    return new Response(200, [
      'data' => $learningPath,
    ]);
  }
}
