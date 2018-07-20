<?php

namespace Blueprint\Html\Builders;

/**
 * Provides Open Graph meta methods
 *
 */

class TwitterCardMeta extends Basic {

  // Initializes the builder

  function init() {

    $this->addComment('Twitter Card Meta');
    $this->setCardType();
    $this->setCardImage();

    // TODO: Add support for video and site @user

  }

  // Sets the image to display with the card

  function setCardImage() {

    // Allow default image to be swapped out for another
    $id   = get_field('featured_image') ?: get_field('seo_twitter_image');
    $src  = wp_get_attachment_image_src($id,'large')[0];
    $src  = apply_filters('twitter_image',$src);

    // Add image meta
    if ($src) {
      $this->addMetaProperty('image',$src);
    }

  }

  // Sets the card type

  function setCardType() {

    $this->addMetaProperty('card','summary_large_image');
    return $this;

  }

  // Sets a meta property

  function addMetaProperty($name,$content) {

    $this->addHtml("<meta property='twitter:$name' content='$content'>");
    return $this;

  }

}
