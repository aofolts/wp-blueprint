<?php

namespace Blueprint\Acf\Fields;

class Image extends Field {

  // Initializes the field

  function init() {

    $this->setType('image');
    $this->setReturnFormat('id');
    $this->setLibrary('post');

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

    // TODO: limit to valid image sizes

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
