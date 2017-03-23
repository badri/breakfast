<?php

namespace Drupal\breakfast\Plugin\Breakfast;

use Drupal\breakfast\BreakfastBase;

/**
 * A dessert or two whould be great!
 *
 *
 * @Breakfast(
 *   id = "sweet",
 *   deriver = "Drupal\breakfast\Plugin\Derivative\Sweets"
 * )
 */
class Sweet extends BreakfastBase {

  public function servedWith() {
    return [];
  }

}
