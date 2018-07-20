<?php

namespace Blueprint\Acf\Groups;

class FeaturedImage extends Group {

  // Initializes the group

  protected function init() {

    $this->setPosition('side');

    $this->addImage('featured_image')
      ->addSaveKey('_thumbnail_id');

  }

}
