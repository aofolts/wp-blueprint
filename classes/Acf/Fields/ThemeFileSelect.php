<?php

namespace Blueprint\Acf\Fields;

class ThemeFileSelect extends Select {

  // Sets the glob

  function setGlob($glob) {

    $glob = get_template_directory() . '/' . $glob;

    foreach ($glob as $file) {

      $key = basename($file);
      $val = $file;
      $this->field['choices'][$key] = $val;

    }

  }

}
