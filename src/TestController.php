<?php

namespace EsnTest;

use EsnTest\Controller\EsnFetcher;

/**
 * Class for the exercise.
 */
class TestController extends EsnFetcher {
  private $articles;
  public function __construct()
  {
    $this->articles = json_decode(file_get_contents('src/Assets/news.json'));
  }
  /**
   * Returns the needed data for solving task 2.
   *
   * You might need extra functions for this test.
   *
   * @return
   *   The complete article data set.
   */
  public function getNews() {
    return $this->articles;
  }

  /**
   * Returns the needed data for solving task 2.
   *
   * You might need extra functions for this test.
   *
   * @return
   *   The number of articles.
   */
  public function countNews() {
    return count($num_articles);
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

    return ;
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

    return ;
  }

}
