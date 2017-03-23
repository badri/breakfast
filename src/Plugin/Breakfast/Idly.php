<?php

namespace Drupal\breakfast\Plugin\Breakfast;

use Drupal\breakfast\BreakfastBase;

/**
 * Idly! can't imagine a south Indian breakfast without it.
 *
 *
 * @Breakfast(
 *   id = "idly",
 *   label = @Translation("Idly"),
 *   image = "https://upload.wikimedia.org/wikipedia/commons/1/11/Idli_Sambar.JPG",
 *   ingredients = {
 *     "Rice Batter",
 *     "Black lentils"
 *   }
 * )
 */
class Idly extends BreakfastBase {

  public function servedWith() {
    return [
      "Sambar",
      "Coconut Chutney",
      "Onion Chutney",
      "Idli podi",
    ];
  }

}
