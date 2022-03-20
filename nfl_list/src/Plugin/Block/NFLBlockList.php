<?php

namespace Drupal\nfl_list\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Block to show NFL teams list as per the rank.
 *
 * @Block(
 *   id = "nfl_block_list",
 *   admin_label = @Translation("NFL Block List")
 * )
 */
class NFLBlockList extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * @var \Drupal\nfl_list\NFLData
   */
  protected $nflData;

  /**
   * Constructor.
   *
   * @param array $configuration
   * @param $plugin_id
   * @param $plugin_definition
   * @param $nflData \Drupal\nfl_list\NFLData
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, $nflData) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->nflData = $nflData;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('nfl_data')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Get the list calling the method defined in service nfl_data.
    $nfl_teams = $this->nflData->getList();

    return [
      '#theme' => 'nfl_list',
      '#nfl_data' => $nfl_teams,
    ];
  }

  /**
   * The maximum age for which this object may be cached.
   *
   * @return int
   *   The maximum time in seconds that this object may be cached.
   */
  public function getCacheMaxAge() {
    return 0;
  }

}