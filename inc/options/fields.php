<?php

$social = new_field_group('site_social_accounts')
  ->setLocation('options_page','social')
  ->setLabelPlacement('top');

  // TODO:
  $accounts = array(
    'facebook'  => 'Facebook',
    'instagram' => 'Instagram',
    'linkedin'  => 'LinkedIn',
    'twitter'   => 'Twitter'
  );

  foreach ($accounts as $key => $label) {

    $social->addTab($label);

    $g = $social->addGroup('site_' . $key)
      ->hideLabel(true)
      ->setLabel($label)
      ->setLayout('table');

      $g->addUrl('link')
        ->setRequired(false);

      $g->addText('username')
        ->setRequired(false)
        ->setPrepend('@');

  }
