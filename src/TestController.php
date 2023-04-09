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
   *   The data you decide to return.
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
   *   The data you decide to return.
   */
  public function countNews() {
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
