<?php

/**
 * @file
 * Contains Drupal\breakfast\Plugin\Field\FieldFormatter\BreakfastFormatter.
 */

namespace Drupal\breakfast\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the breakfast formatter.
 *
 * @FieldFormatter(
 *   id = "breakfast_formatter",
 *   module = "breakfast",
 *   label = @Translation("Simple breakfast formatter"),
 *   field_types = {
 *     "breakfast_choice"
 *   }
 * )
 */
class BreakfastFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items) {
    $elements = array();

    foreach ($items as $delta => $item) {
      $breakfast_item = \Drupal::service('plugin.manager.breakfast')->getDefinition($item->value);
      $elements[$delta] = array(
        '#markup' => '<h1>'. $breakfast_item['label'] . '</h1>',
      );
    }

    return $elements;
  }

}
