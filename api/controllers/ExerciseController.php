<?php

class ExerciseController
{

  public function complete()
  {
    $userId = $_SESSION['userId'];
    $LearningPath = LearningPath::findByUserId($userId);
    $currentExercise = json_decode($_SESSION['currentExercise']);

    $awnsers = json_decode($_POST['awnsers']);

    $feedback = [];

    $correctCount = 0;
    for ($i = 0; $i  < 3; $i++) {
      $actualAwser = $currentExercise->exercises[$i]->awnser;
      $correct = $actualAwser == ($awnsers[$i]);
      $feedback[] = $correct;
      if ($correct) {
        $correctCount++;
      }
    }

    if ($correctCount == 3) {
      $moduleId = $LearningPath->modules[$LearningPath->currentModule]['id'];
      DbConnector::statementWithParams("update sub_modules set progress = 1 where module_id = ?",[$moduleId]);
    }
    return new Response(200, ["aserts" => $feedback]);
  }

  public function create()
  {
    // TODO: limitar el rate de generacion de ejercicios 
    $userId = $_SESSION['userId'];
    $LearningPath = LearningPath::findByUserId($userId);

    $promnt = json_decode(file_get_contents('../iaMessageTemplate.json'));

    $message = file_get_contents('../exercisePromt');
    $message = str_replace('%lenguage%', $LearningPath->lenguage, $message);
    $message = str_replace('%level%', $LearningPath->level, $message);

    $module = $LearningPath->modules[$LearningPath->currentModule];
    $theme = $module['title'];
    $message = str_replace('%theme%', $theme, $message);

    $subTheme = $module['subModules'][$LearningPath->currentSubmodule]['title'];
    $message = str_replace('%subTheme%', $subTheme, $message);

    $outputTemplate = file_get_contents('../exerciseTemplate.json');
    $promnt->messages[0]->content = $message . $outputTemplate;

    $options = [
      'http' => [
        'method'  => 'POST',
        'header'  => 'Content-type: application/json',
        'content' => json_encode($promnt),
      ],
    ];
    $context  = stream_context_create($options);
    $iaResponse = file_get_contents('http://localhost:11434/api/chat', false, $context);

    $exercise = json_decode($iaResponse)->message->content;
    $_SESSION['currentExercise'] = $exercise;

    return new Response(201, [
      'message' => "Ejercicio generado correctamente",
    ]);
  }

  public function show()
  {
    $userId = $_SESSION['userId'];
    $LearningPath = LearningPath::findByUserId($userId);

    $module = $LearningPath->modules[$LearningPath->currentModule]['title'];
    $subModule = $LearningPath->modules[$LearningPath->currentModule]['subModules'][$LearningPath->currentSubmodule]['title'];

    return new Response(200, [
      'exercise' => json_decode($_SESSION['currentExercise']),
      'module' => $module,
      'subModule' => $subModule
    ]);
  }
}
