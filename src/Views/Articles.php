<?php

namespace EsnTest\Views;

use EsnTest\TestController;

/**
 * Class Front.
 *
 * By extending this class from AbstractView, we have available the
 * render() method, that will load the desired twig template with the
 * variables needed.
 */
class Articles extends AbstractView {

  /**
   * Articles view.
   *
   * @route("articles")
   *
   * @alias("articles")
   */
  public function index() {
    // We call our test controller for the data we need later in twig.
    $testController = new TestController();

    // And we render the data.
    $this->render('articles.twig', [
      'articles' => $testController->getNews(),
      // 'num_articles' => $testController->countNews(),
    ]);
  }

  /**
   * Single Article view.
   *
   * @route("article/{slug}")
   *
   * @alias("article/{slug}")
   */
  public function show($slug) {
    // We call our test controller for the data we need later in twig.
    $testController = new TestController();

    // And we render the data.
    // echo "$slug";
    // die;
    // $slug = 'raldred1';
    $this->render('article.twig', [
      'article' => $testController->getArticle($slug),
      // 'num_articles' => $testController->countNews(),
    ]);
  }
}
