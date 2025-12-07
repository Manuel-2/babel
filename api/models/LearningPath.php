<?php

class LearningPath
{
  public int $id;
  public string $lenguage;
  public string $level;
  public string $objective;
  public float $totalProgress;

  public array $modules;

  public function __construct($language, $level, $objective, $modules, $id = false)
  {
    $this->lenguage = $language;
    $this->level = $level;
    $this->objective = $objective;
    $this->modules = $modules;
    $this->totalProgress = 0;

    if ($id) {
      $this->id = $id;
    }
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
    $this->id = $learingPathId;

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

  public function delete()
  {
    $subModulesMinId = $this->modules[0]['id'];
    $subModulesMaxId = $this->modules[6]['id'];

    DbConnector::statementWithParams('delete from sub_modules where module_id Between ? and ?', [$subModulesMinId, $subModulesMaxId]);
    DbConnector::statementWithParams('delete from modules where id Between ? and ?', [$subModulesMinId, $subModulesMaxId]);
    DbConnector::statementWithParams('delete from learning_paths where id = ?', [$this->id]);
  }

  public static function findByUserId(int $userId): LearningPath
  {
    $learingPathData  = DbConnector::statement("select * from learning_paths where user_id = $userId order by id")[0];
    $learingPathID = $learingPathData['id'];
    $modulesData = DbConnector::statement("select * from modules where learning_path_id = $learingPathID");

    $currentModule = 0;
    $currentSubmodule = 0;
    $progressSum = 0;
    foreach ($modulesData as &$module) {
      $moduleId = $module['id'];
      $subModulesData = DbConnector::statementWithParams("select * from sub_modules where module_id = ?", [$moduleId]);
      $module['subModules'] = $subModulesData;

      $moduleProgress = ($subModulesData[0]['progress'] + $subModulesData[1]['progress']) / 2;
      $module['progress'] = $moduleProgress;
      $progressSum += $moduleProgress;

      if ($moduleProgress == 1) {
        $currentModule++;
      }

      if ($moduleProgress == 0.5) {
        $currentSubmodule = 1;
      }
    }
    //-------- 
    $lan = $learingPathData['lenguage'];
    $objective = $learingPathData['objective'];
    $level = $learingPathData['level'];

    $learningPathInstance = new LearningPath($lan, $level, $objective, $modulesData, $learingPathID);
    $learningPathInstance->totalProgress = $progressSum / 7;
    $learningPathInstance->currentModule = $currentModule;
    $learningPathInstance->currentSubmodule = $currentSubmodule;

    return $learningPathInstance;
  }
}
