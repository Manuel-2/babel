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

  public static function findByUserId(int $userId)
  {
    $learingPathData  = DbConnector::statement("select * from learning_paths where user_id = $userId order by id")[0];
    $learingPathID = $learingPathData['id'];
    $modulesData = DbConnector::statement("select * from modules where learning_path_id = $learingPathID");

    $learingPathData['totalProgress'] = 0;
    foreach ($modulesData as &$module) {
      $moduleId = $module['id'];
      $subModulesData = DbConnector::statementWithParams("select * from sub_modules where module_id = ?", [$moduleId]);
      $module['subModules'] = $subModulesData;

      $moduleProgress = ($subModulesData[0]['progress'] + $subModulesData[1]['progress']) / 2;
      $module['progress'] = $moduleProgress;
      $learingPathData['totalProgress'] += $moduleProgress;
    }
    $learingPathData['totalProgress'] = $learingPathData['totalProgress'] / 7;

    $learingPathData['modules'] = $modulesData;
    return $learingPathData;
  }
}
