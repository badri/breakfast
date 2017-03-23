<?php

namespace Drupal\breakfast\Plugin\Field\FieldWidget;

use Drupal\breakfast\BreakfastPluginManager;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Plugin implementation of the 'field_breakfast' widget.
 *
 * @FieldWidget(
 *   id = "breakfast_select",
 *   module = "breakfast",
 *   label = @Translation("Breakfast Choice"),
 *   field_types = {
 *     "breakfast_choice"
 *   }
 * )
 */
class BreakfastWidget extends WidgetBase implements ContainerFactoryPluginInterface {

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
                              array $third_party_settings,
                              BreakfastPluginManager $breakfast_manager) {

    parent::__construct($plugin_id,
                        $plugin_definition,
                        $field_definition,
                        $settings,
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
      $configuration['third_party_settings'],
      $container->get('plugin.manager.breakfast')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items,
                              $delta,
                              array $element,
                              array &$form,
                              FormStateInterface $form_state) {

    $value = isset($items[$delta]->value) ? $items[$delta]->value : '';
    $options = [];
    $breakfast_items = $this->breakfastManager->getDefinitions();
    foreach ($breakfast_items as $plugin_id => $breakfast_item) {
      $options[$plugin_id] = $breakfast_item['label'];
    }

    $element = [
      '#type' => 'select',
      '#options' => $options,
      '#default_value' => $value,
      '#multiple' => FALSE,
    ];

    return ['value' => $element];
  }

  public function validate($element, FormStateInterface $form_state) {
    $value = $element['#value'];
    $form_state->setValueForElement($element, $value);
  }

}
