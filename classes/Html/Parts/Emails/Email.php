<?php

namespace Blueprint\Html\Parts\Emails;

use \Blueprint\Html\Parts as Parts;
use \Blueprint\Html\Parts\Part as Part;

class Email extends Part {

  protected $body;
  protected $content;
  protected $head;
  protected $header;
  protected $title;
  protected $titleContainer;

  // Initializes the part
  protected function init() 
  {
    $this->setTag('html');
    $this->setHead();
    $this->setHeader();
    $this->setContent();
  }

  // Gets the template body
  function getBody() 
  {
    return $this->body ?: $this->setBody();
  }

  // Gets the content part
  function getContent() 
  {
    return $this->content ?: $this->setContent();
  }

  // Sets the template body
  protected function setBody()
  {
    $this->body = new_template_part('body#body');
    return $this->body;
  }

  // Sets the content container
  protected function setContent() 
  {
    $container = $this->getBody()->addPart('table#content');

    $this->content = $container->addPart('tr#row-content')
      ->addPart('td#cell-content');

    return $this->content;
  }

  // Sets the template head 
  protected function setHead() 
  {
    $this->head = $this->addPart('head#head');
    $this->setStyle();
  }

  // Sets the template header
  protected function setHeader() 
  {
    $header = $this->header = $this->getBody()->addPart('table#header');
    $this->setTitleContainer();
  }

  // Sets the title text
  function setTitle($title) 
  {
    $this->title = $title;
    return $this;
  }

  // Sets the style part
  protected function setStyle() 
  {
    $style = $this->style = $this->head->addPart('style#style')
      ->setAttribute('type','text/css');

    $style->addHtml("

      #body {
        background: #f7f7f7;
        color: #444;
        font-family: 'Helvetica',sans-serif;
        font-weight: 300;
        padding:5px;
        margin: 0;
      }

      #header, #content {
        table-layout: fixed;
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        padding: 25px;
      }

      #title {
        text-align: center;
        margin-bottom:0;
      }

      #header {

      }

      #content {
        background: white;
      }

    ");
  }

  // Sets the title part
  protected function setTitleContainer() 
  {
    $container = $this->header->addPart('tr#container-title');
    $cell      = $container->addPart('td#cell-title');
    $title = $this->titlePart = $cell->addH1('#title');
  }

  // Extends Part build method
  function build() 
  {
    $this->titlePart->addText($this->title);
    $this->addPart($this->body);

    return parent::build();
  }

}