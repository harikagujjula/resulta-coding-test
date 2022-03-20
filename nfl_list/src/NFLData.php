<?php

namespace Drupal\nfl_list;

use Drupal\Component\Serialization\Json;

/**
 * Service to get the response list from an API endpoint.
 */
class NFLData {

  /**
   * Resturns the json response of NFL team list.
   * 
   * @return array
   *   Returns Json response of List.
   */
  public function getList() {
    $nfl_data = $nfl_teams = [];
    // For now hard coding the API end point. It is not a good practice to hard
    // code the API url. Rather, We can define the api end point, api key 
    // through a configuration form or use settings.php variable, if it 
    // is always constant.
    $nfl_data = file_get_contents(
      'https://delivery.chalk247.com/team_list/NFL.JSON?api_key=74db8efa2a6db279393b433d97c2bc843f8e32b0'
    );
    // Decode the Json data response.
    $response = Json::decode($nfl_data, TRUE);

    if (!empty($response['results']['data']['team'])) {
      $nfl_teams = $response['results']['data']['team'];
    }

    return $nfl_teams;
  }

}