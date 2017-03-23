<?php

namespace Drupal\breakfast\Plugin\Field\FieldFormatter;

use Drupal\breakfast\BreakfastPluginManager;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

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
class BreakfastFormatter extends FormatterBase implements ContainerFactoryPluginInterface {

  /**
   * Instance of BreakfastPluginManager service.
   *
   * @var \Drupal\breakfast\BreakfastPluginManager
   */
  protected $breakfastManager;

  /**
   * {@inheritdoc}
   */
  public function __construct($plugin_id,
                              $plugin_definition,
                              FieldDefinitionInterface $field_definition,
                              array $settings,
                              $label,
                              $view_mode,
                              array $third_party_settings,
                              BreakfastPluginManager $breakfast_manager) {

    parent::__construct($plugin_id,
                        $plugin_definition,
                        $field_definition,
                        $settings,
                        $label,
                        $view_mode,
                        $third_party_settings);

    $this->breakfastManager = $breakfast_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container,
                                array $configuration,
                                $plugin_id,
                                $plugin_definition) {

    return new static(
      $plugin_id,
      $plugin_definition,
      $configuration['field_definition'],
      $configuration['settings'],
      $configuration['label'],
      $configuration['view_mode'],
      $configuration['third_party_settings'],
      $container->get('plugin.manager.breakfast')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    foreach ($items as $delta => $item) {
      $breakfast_item = $this->breakfastManager->createInstance($item->value);
      $markup = '<h1>' . $breakfast_item->getName() . '</h1>';
      $markup .= '<img src="' . $breakfast_item->getImage() . '" width="300"/>';
      $markup .= '<h2>Goes well with:</h2>' . implode(", ", $breakfast_item->servedWith());
      $elements[$delta] = [
        '#markup' => $markup,
      ];
    }

    return $elements;
  }

}
