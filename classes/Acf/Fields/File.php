<?php

namespace Blueprint\Acf\Fields;

class File extends Field {

  // Initializes the field

  function init() {

    $this->setType('file');
    $this->setReturnFormat('url');
    $this->setLibrary('post');

  }

  // Sets the file return format

  function setReturnFormat($format='id') {

    $choices = array('array','url','id');
    if (!in_array($format,$choices)) {$format = 'id';}

    $this->field['return_format'] = $format;
    return $this;

  }

  // Sets the library to attach the file to

  function setLibrary($library) {

    // "post" and "uploadedTo" are equavilent
    $choices = array('all','post','uploadedTo');

    if (!in_array($library,$choices)) {$library = 'all';}

    // Rename "post" to ACF value "uploadedTo"
    if ($library == 'post') {$library = 'uploadedTo';}

    $this->field['library'] = $library;
    return $this;

  }

  // Sets the max file size

  function setMaxSize($size) {

    $this->field['max_size'] = $size;
    return $this;

  }

  // Sets the min file size

  function setMinSize($size) {

    $this->field['min_size'] = $size;
    return $this;
    
  }

  // Sets the file type

  function setFileType($type) {

    $this->field['mime_types'] = $type;
    return $this;

  }

}
