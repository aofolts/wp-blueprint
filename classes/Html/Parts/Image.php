<?php

namespace Blueprint\Html\Parts;

use \Blueprint\Html\Traits\Builders as Builders;

class Image extends Part {

  use Builders\Media;

  protected $isBackground;
  protected $isLazy;
  protected $size;
  protected $class;
  protected $crop;
  protected $img;
  protected $imgId;
  protected $post;
  protected $src;
  protected $srcLowRes;

  // Initializes the part

  function init() {

    $this->setLazy(true);

  }

  // Returns an attachement image url
  static function getUrl($size,$img_id) {

    // TODO: sizes array and theme filter
    $url = wp_get_attachment_image_src($img_id,$size);
    $url = $url[0];

    return $url;

  }

  // Returns the actual image element part
  function getImage() {

    if (!isset($this->image)) {
      $this->setImage();
    }

    return $this->image;

  }

  static function getSizes($returnType=null) {
    $sizes =  array(
      'blog' => array(
        'label' => 'Medium'
      ),
      'full' => array(
        'label' => 'Full'
      ),
      'marquee' => array(
        'label' => 'Large'
      )
    );
    if ($returnType == 'key') {return array_keys($sizes);}
    else {return $sizes;}
  }

  // Returns an srcset
  protected function makeSrcset($img_id,$sizes=null) {

    // TODO: more accurate sizing

    $set = '';
    $sizes = array(
      'medium' => '80w',
      'large'  => '1200w'
    );

    foreach ($sizes as $size => $width) {
      $url = wp_get_attachment_image_src($img_id,$size);
      $url = $url[0];
      if ($url) {$set .= "$url $width,";}
    }

    return $set;

  }

  // Sets the image alt attribute
  function setAlt($alt) {

    // Gets the image meta data
    if (is_int($alt)) {
      $meta = wp_get_attachment_metadata($alt);
      diedump($meta);
    }

  }

  // Sets the image as $this or $this->image
  // depending on whether it needs a container
  protected function setImage() {

    // If is a background
    if ($this->isBackground) {
      $this->image = (new Part())
        ->setTag('img');
      $this->addPart($this->image);
    // If is just an image
    } else {
      $this->image = $this;
      $this->setTag('img');
    }

    return $this->image;

  }

  // Enables or disables lazy functionality
  function setLazy($bool) {

    $this->isLazy = (bool) $bool;
    return $this;

  }

  // Sets the image src
  function setSrc($src=null) {

    // If attachement ID given
    if (intval($src)) {

      $srcset = $this->makeSrcset($src);
      $this->getImage()->setAttribute('data-srcset',$srcset);
      $this->image->setAttribute('src',self::getUrl('lowres',$src));
      $alt =  get_post_meta($src,'_wp_attachment_image_alt',true);
      $this->getImage()->setAlt($alt);
      $this->setLazy(true);

    }

    // If external image url given
    elseif (is_string($src)) {

      $srcset = false;
      if (strpos($src,'http') !== 0) {
        $src = get_template_directory_uri() . '/assets/img/' . $src;
      }
      $this->getImage()->setAttribute('src',$src);

    }

    return $this;

  }


  // function setCrop($crop=false) {
  //   // $this->crop = (bool) $crop;
  //   // if (!$crop) {
  //   //   $this->img = $this;
  //   //   $this->setTag('img');
  //   // } else {
  //   //   $this->setTag('div');
  //   //   $this->setImg();
  //   // }
  //   return $this;
  // }

  // Sets the largest size the image will display at
  function setSize($size) {

    if (!in_array($size,self::getSizes('key'))) {wp_die('Invalid setSize size.');}
    $this->size = $size;
    // TODO: class for image or container, depending
    return $this;

  }

  // Extends parent build method
  function build() {

    $image = $this->getImage()
      ->addClass('image');

    if ($this->isBackground) {
      $this->addClass('container-background');
    }

    if ($this->isLazy) {
      $this->addClass('lazy-item lazy-media lazy-unloaded');
    }

    return parent::build();

  }

}
