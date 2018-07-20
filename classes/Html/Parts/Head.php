<?php

namespace Blueprint\Html\Parts;

use \Blueprint\Html\Builders as Builders;

class Head extends Part {

  protected $metaDescription;
  protected $metaKeywords;
  protected $metaTitle;
  protected $openGraphMeta;
  protected $post;
  protected $seo;
  protected $twitterCardMeta;

  // Initializes the part

  function init() {

    // Set the tag
    $this->setTag('head');

    // Store the SEO field (if it exists)
    $this->seo = get_field('seo');

    // Set meta elements
    $this->addComment('Site and Page Info');
    $this->setMetaTitle();
    $this->setCharSet();
    $this->setMetaDescription();
    $this->setMetaKeywords();
    $this->setMetaViewport();

    // Store a new OpenGraphMeta instance
    $this->openGraphMeta = new Builders\OpenGraphMeta();

    // Store TwitterCardMeta instance
    $this->twitterCardMeta = new Builders\TwitterCardMeta();

  }

//   // Content type meta
// $head->addMeta('charset','UTF-8');
//
// // Description meta
// $head->addMeta('name','description')
//   ->setAttribute('content',get_bloginfo('description'));
//
// // Viewport meta
// $head->addMeta('name','viewport')
//   ->setAttribute(
//     'content',
//     'width=device-width, initial-scale=1.0'
//   );
//
// $head->addHtml("<!-- Open Graph -->");



  // Adds an HTML meta element

  function addMeta($prop,$val) {

    $part = $this->addPart()
      ->setTag('meta')
      ->setAttribute($prop,$val);

    return $part;

  }

  // Sets the meta character set

  function setCharSet() {

    $this->addHtml("<meta charset='UTF-8'>");
    return $this;

  }

  // Sets the meta description

  function setMetaDescription($description=null) {

    global $post;

    // Uses the site description as a fallback
    $description = $this->setMetaDescription = get_field('seo_description')
      ?: $post->post_excerpt
      ?: get_bloginfo('description');

    $this->addHtml("<meta name='description' content='$description'>");
    return $this;

  }

  // Sets the meta keywords

  function setMetaKeywords($keywords=null) {

    if (!$keywords) {
      $keywords = $this->seo['keywords'] ?? 'Wordpress';
    }

    $this->addHtml("<meta name='keywords' content='$keywords'>");
    return $this;

  }

  // Sets the meta title

  function setMetaTitle($title=null) {

    $site_name = get_bloginfo('name');

    // Set the title dynamically
    if (!$title) {

      $format = $this->seo['title_format'] ?? 'default';
      $title  = $this->seo['title'] ?: get_the_title();

      switch ($format) {
        case 'custom' : $title = "$title"; break;
        default:        $title = "$site_name | $title";
      }

    }

    // Store meta title
    $this->metaTitle = $title;

    // Add meta element
    $part = $this->addPart()
      ->setTag('title')
      ->addHtml($title);

    return $part;

  }

  // Sets the meta viewport

  function setMetaViewport($viewport=null) {

    $viewport = $viewport ?: 'width=device-width, initial-scale=1.0';

    $this->addHtml("<meta name='viewport' content='$viewport'>");
    return $this;

  }

  // Extends parent build method

  function build() {

    $this->addPart($this->openGraphMeta);
    $this->addPart($this->twitterCardMeta);
    $this->addHtml($this->buildWpHead());

    return parent::build();

  }

  // Returns output of wp_head

  function buildWpHead() {

    // Output wp_head and store ob_get_clean
    ob_start();
    wp_head();
    return ob_get_clean();

  }

}
