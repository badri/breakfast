<?php

namespace Drupal\breakfast\Plugin\Breakfast;

use Drupal\breakfast\BreakfastBase;

/**
 * Adds Masala Dosa to your Breakfast menu.
 *
 *
 * @Breakfast(
 *   id = "masala_dosa",
 *   label = @Translation("Masala Dosa"),
 *   image = "https://upload.wikimedia.org/wikipedia/commons/3/34/Paper_Masala_Dosa.jpg",
 *   ingredients = {
 *     "Rice Batter",
 *     "Black lentils",
 *     "Potatoes",
 *     "Onions"
 *   }
 * )
 */
class MasalaDosa extends BreakfastBase {

  public function servedWith() {
    return [
      "Sambar",
      "Coriander Chutney",
    ];
  }

}
