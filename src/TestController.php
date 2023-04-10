<?php

namespace EsnTest;

use EsnTest\Controller\EsnFetcher;
use PhpOffice\PhpSpreadsheet\IOFactory;

/**
 * Class for the exercise.
 */
class TestController extends EsnFetcher {
  private $articles;
  public function __construct()
  {
    parent::__construct();
    $this->articles = $this->getNews();
  }
  /**
   * Returns the needed data for solving task 2.
   *
   * You might need extra functions for this test.
   *
   * @return
   *   The data you decide to return.
   */
  public function getNews2() {
    return $this->articles;
  }

  /**
   * Returns the needed data for solving task 2.
   *
   * You might need extra functions for this test.
   *
   * @return
   *   The data you decide to return.
   */
  public function countNews2() {
    return count($this->articles);
  }

  /**
   * Returns the needed data for solving task 3.
   *
   * You might need extra functions for this test.
   *
   * @return
   *   The data you decide to return.
   */
  public function getArticle($slug) {
    $column = array_column($this->articles, 'slug');
    $index = array_search($slug, $column);
    if ($index !== false) {
      $item = $this->articles[$index];
    } else {
      call_user_func_array([$this, 'notFound'], ['articles/'. $slug]);
      return;
    }
    return $item;
  }

  /**
   * Returns the needed data for solving task 4.
   *
   * You might need extra functions for this test.
   *
   * @return
   *   The data you decide to return.
   */
  public function getDataT4() {
    $curl = curl_init('https://accounts.esn.org/api/v1/sections');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Accept: application/json', 'Content-Type: application/x-www-form-urlencoded']);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    // Execute and get also the response code.
    $resp = curl_exec($curl);
    // Can be the url returns a 404.
    $code = curl_getinfo($curl)['http_code'];
    curl_close($curl);

    if ($code === 404){
      return json_encode([]);
    }
    $resp = json_decode($resp);

    $filteredItems = array_map(function ($item) {
      return [
        'country' => $item->country,
        'label' => $item->label,
        'code' => $item->code,
        'cc' => $item->cc,
        'website' => $item->website,
      ];
    }, $resp);

    $grouped = array_reduce($filteredItems, function ($carry, $item) {
      $country = $item['country'];
      if (!isset($carry[$country])) {
        $carry[$country] = [];
      }
      $carry[$country][] = $item;
      return $carry;
    }, []);

    foreach ($grouped as &$group) { // sort
      usort($group, function ($a, $b) {
        return strcmp($a['label'], $b['label']);
      });
    }
    return $grouped;
  }

  /**
   * Returns the needed data for solving task 5.
   *
   * You might need extra functions for this test.
   *
   * @return
   *   The data you decide to return.
   */
  public function getDataT5() {
    $reader = IOFactory::createReader('Xlsx');
    $reader->setReadDataOnly(true);
    $spreadsheet = $reader->load('codes.xlsx');
    $worksheet = $spreadsheet->getActiveSheet();
    $data = $worksheet->toArray();
    $data = array_map('current', $data);
    array_shift($data);
    $res = [];
    foreach ($data as $key => $item) {
      $tmpres = $this->getCardData($item);
      $res[] = $tmpres ? $tmpres : ['card_code' => $item];
    }
    return $res;
  }
}
