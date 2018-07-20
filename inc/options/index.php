<?php

require 'fields.php';

$options = new_options_page('site-options')
  ->setRedirect(false);

$social = $options->addSubPage('social');
