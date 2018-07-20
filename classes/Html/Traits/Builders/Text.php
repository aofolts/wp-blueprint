<?php

namespace Blueprint\Html\Traits\Builders;

use \Blueprint\Html\Parts as Parts;

trait Text {

  /**
   * Text elements accept a $text argument instead of
   * $name, because they ALWAYS need text, but don't
   * always need a name/class
   */

  // Adds a paragraph element
  function addP($name=null) {

    $part = (new Parts\Text($name))
      ->setTag('p');

    return $this->addPart($part);

  }

  // Adds a paragraph element with a class of 'p2'
  function addP2($name=null) {

    return $this->addP($name)
      ->addClass('p2');

  }

  // Adds content or the_content as HTML
  function addContent($content=null) {

    global $post;

    $content = $content ?: $post->post_content ?: '';
    $content = apply_filters('the_content',$content);

    return $this->addHtml($content);


  }

  // Adds an H1 element
  function addH1($name) {

    $part = (new Parts\Text($name))
      ->setTag('h1');

    return $this->addPart($part);

  }

  // Adds an H2 element
  function addH2($name) {

    $part = (new Parts\Text($name))
      ->setTag('h2');

    return $this->addPart($part);

  }

  // Adds an H3 element
  function addH3($name) {

    $part = (new Parts\Text($name))
      ->setTag('h3');

    return $this->addPart($part);

  }

  // Adds an H4 element
  function addH4($name) {

    $part = (new Parts\Text($name))
      ->setTag('h4');

    return $this->addPart($part);

  }

}
