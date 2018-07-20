<?php

namespace Blueprint\Acf\Groups;

class Seo extends Group {

  protected $seoGroup;

  // Initializes the group

  protected function init() {

    $g = $this->addGroup('seo');

      // General Settings

      $g->addTab('General');

        $blog_name = get_bloginfo('name');

        $g->addSelect('title_format')
          ->setChoices(array(
            'default' => "Site Name | Title",
            'custom'  => "Custom"
          ))
          ->setInstructions('How to format the meta title (below).');

        $g->addText('title')
          ->setMaxLength(90)
          ->setRequired(false)
          ->setInstructions('Sets the meta title of the current post.');

        $general_settings_link = get_bloginfo('url') . '/wp-admin/options-general.php';

        $g->addTextarea('description')
          ->setInstructions("Sets the meta description. Defaults to the post excerpt or the <a href='$general_settings_link' target='_blank'>Site Tagline</a>.")
          ->setRequired(false)
          ->setMinLength(50)
          ->setMaxLength(300);

        $g->addText('keywords')
          ->setMaxLength(120)
          ->setInstructions("Comma-seperated list of words or phrases that people would use to search for this content.");

      // Facebook Settings

      $g->addTab('Facebook');

        $g->addText('og_title')
          ->setLabel('Facebook Title')
          ->setMaxLength(90)
          ->setRequired(false)
          ->setInstructions('Customizes the Facebook title. Defaults to general Title');

        $g->addImage('og_image')
          ->setRequired(false)
          ->setLabel('Facebook Image')
          ->setInstructions('An image to display for Facebook shares. Defaults to Featured Image. Recommended size: 1200 by 630 pixels');

      // Twitter Settings

      $g->addTab('Twitter');

        $g->addText('twitter_title')
          ->setMaxLength(90)
          ->setRequired(false)
          ->setInstructions('Customizes the meta title of the current post.');

        $g->addTextarea('twitter_description')
          ->setInstructions("Customizes the meta description. Defaults to the post excerpt (if possible) or the <a href='$general_settings_link' target='_blank'>Site Tagline</a>)")
          ->setRequired(false)
          ->setMinLength(50)
          ->setMaxLength(300);

        $g->addImage('twitter_image')
          ->setRequired(false)
          ->setInstructions('Replaces the default Featured Image. The recommended size: 1024 by 512 pixels.');

  }

}
