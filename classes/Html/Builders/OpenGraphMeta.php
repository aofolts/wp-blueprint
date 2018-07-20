<?php

namespace Blueprint\Html\Builders;

/**
 * Provides Open Graph meta methods
 *
 */

class OpenGraphMeta extends Basic {

  // Initializes the builder

  function init() {

    $this->addComment('Open Graph Meta');
    $this->setTitle();
    $this->setDescription();
    $this->setCardImage();
    $this->addMetaProperty('url',get_permalink());
    $this->addMetaProperty('type','website');
    $this->addMetaProperty('site_name',get_bloginfo('name'));

  }

  // Sets the og:description

  function setDescription() {

    global $post;

    $desc = get_field('seo_og_title')
      ?: $post->post_excerpt
      ?: get_bloginfo('description');

    $this->addMetaProperty('description',$desc);
    return $this;

  }

  // Sets the image to display with the card

  function setCardImage() {

    // Allow default image to be swapped out for another
    $id   = get_field('featured_image') ?: get_field('seo_og_image');
    $src  = wp_get_attachment_image_src($id,'large')[0];
    $src  = apply_filters('open_graph_image',$src);

    // Add image meta
    if ($src) {
      $this->addMetaProperty('image',$src);
    }

  }

  // Sets the og:title

  function setTitle($title=null) {

    if (!$title) {
      $title = get_field('seo_og_title') ?: get_the_title();
    }

    $this->addMetaProperty('title',$title);
    return $this;

  }

  // Sets a meta property

  function addMetaProperty($name,$content) {

    $this->addHtml("<meta property='og:$name' content='$content'>");
    return $this;

  }

}
