<?php

namespace Blueprint\Acf\Fields;

class Gallery extends Field {

  function init() {
    $this->setType('gallery');
    $this->setLibrary('post');
  }

  // Sets the maximum number of images
  function setMax($max) {
    $this->field['max'] = (int) $max;

    return $this;
  }

  // Sets the minimum number of images
  function setMin($min) {
    $this->field['min'] = (int) $min;

    return $this;
  }

   // Sets the library
   function setLibrary($library='post') {
    switch ($library) {
      case 'post' : $library = 'uploadedTo'; break;
      case 'all'  : $library = 'all'; break;
      default     : $library = 'uploadedTo';
    }

    $this->field['library'] = $library;
    return $this;
  }

  // Sets the file type
  function setFileType($type) {
    // Covert args to array
    $type = func_get_args();
    $type = implode(',',$type);

    $this->field['mime_types'] = $type;
    return $this;
  }

  // Sets the maximum image height
  function setMaxHeight($height) {
    $this->field['max_height'] = (int) $height;

    return $this;
  }

  // Sets the minimum image height
  function setMinHeight($height) {
    $this->field['min_height'] = (int) $height;

    return $this;
  }

  // Sets the maximum image setWidth
  function setMaxWidth($width) {
    $this->field['max_width'] = $width;

    return $this;
  }

  // Sets the minimum image width

  function setMinWidth($width) {
    $this->field['min_width'] = $width;

    return $this;
  }

  // Sets the preview size
  function setPreviewSize($size) {
    $this->field['preview_size'] = $size;

    return $this;
  }

  // Sets the return format
  //
  // Choices of 'array' (Image Array), 'url' (Image URL) or 'id' (Image ID)
  function setReturnFormat($format) {
    $this->field['return_format'] = $format;

    return $this;
  }

}