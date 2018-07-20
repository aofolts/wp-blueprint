<?php

namespace Blueprint\Acf\Fields;

class TextArea extends Text {

  // Initializes the field

  function init() {

    $this->setType('textarea');
    $this->setRows(3);
    $this->setNewLines(false);

  }

  // Specifies how to handle new lines

  function setNewLines($type) {

    $options = array(
      'wpauto', // Adds p tags to new lines
      'br',      // Adds br tags to new lines
      ''        // Removes line breaks
    );

    // Set fallback to '' (remove line breaks)
    if (!$type || !in_array($options,$type)) {
      $type = '';
    }

    $this->field['new_lines'] = $type;
    return $this;

  }

  // Set the number of rows

  function setRows($rows) {

    $this->field['rows'] = $rows;
    return $this;

  }

}
