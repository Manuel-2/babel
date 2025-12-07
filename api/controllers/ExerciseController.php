<?php

class ExerciseController
{

  public function generate()
  {
    // TODO: limitar el rate de generacion de ejercicios

    return new Response(200, [
      'debug' => "ia generacion"
    ]);
  }
}
