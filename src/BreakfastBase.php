<?php

namespace Drupal\breakfast;

use Drupal\Component\Plugin\PluginBase;

abstract class BreakfastBase extends PluginBase implements BreakfastInterface {

  /*
   * Retrieve name().
   */
  public function getName() {
    return $this->pluginDefinition['label'];
  }

  /*
   * Retrieve image().
   */
  public function getImage() {
    return $this->pluginDefinition['image'];
  }

}
