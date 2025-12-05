<?php

class LearningPath
{

  public string $lenguage;
  public string $level;
  public string $objective;

  public array $modules;

  public function __construct($language, $level, $objective, $modules)
  {
    $this->lenguage = $language;
    $this->level = $level;
    $this->objective = $objective;

    $this->modules = $modules;
  }

  public function save()
  {
    $userId = $_SESSION['userId'];
    $learingPathId = DbConnector::insertStatement(
      'INSERT INTO learning_paths (user_id, lenguage, objective, level)
      values (:userId, :lenguage, :objective, :level)',
      [
        'userId' => $userId,
        'lenguage' => $this->lenguage,
        'objective' => $this->objective,
        'level' => $this->level
      ]
    );

    foreach ($this->modules as $module) {
      $moduleId = DbConnector::insertStatement(
        'INSERT INTO modules (learning_path_id, title)
        values (:pathId, :title)',
        [
          'pathId' => $learingPathId,
          'title' => $module->title
        ]
      );

      foreach ($module->submodules as $subModule) {
        DbConnector::insertStatement(
          'INSERT INTO sub_modules (module_id,title)
          values (:moduleId, :title)
          ',
          [
            'moduleId' => $moduleId,
            'title' => $subModule->title
          ]
        );
      }
    }
  }
}
