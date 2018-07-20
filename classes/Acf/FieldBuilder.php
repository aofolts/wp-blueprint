<?php

namespace Blueprint\Acf;

use \Blueprint\Acf\Fields as Fields;

trait FieldBuilder {

  protected $prefix;
  protected $fields = array();

  // Adds an accordion field
  function addAccordion($name) {

    $label = $name;
    $name = 'accordion_' . rand();
    $field = (new Fields\Accordion($name))
      ->setLabel($label);

    return $this->addField($field);

  }

  // Adds a new field
  protected function addField($field) {
    // Prefix field name if it is a child of a group field
    if (method_exists($this,'preAddField')) {
      $this->preAddField($field);
    }

    // Add child field key prefix
    if ($this->prefix) {
      // Pass key prefix to child (if it is a group field)
      if (method_exists($field,'setPrefix')){
        $field->setPrefix($this->prefix);
      }

      $key    = $field->getKey('raw');
      $key    = 'field_' . $this->prefix . '_' . $key;
      $field->setKey($key);
    }

    array_push($this->fields,$field);
    return $field;
  }

  // TODO: Check if is in field group
  // Otherwise, need way to prefix 'button'
  function addButton($name='button') {

    if (!$name) {$name = 'button';}

    $field = (new Fields\Group($name));

    $field->addText('label');

    $link_type = $field->addSelect('link_type')
      ->setWidth('40%')
      ->setChoices(array(
        'external' => 'External (Another Website)',
        'internal' => 'Internal (Your Website)',
        'section'  => 'Section',
        'file'     => 'File (On Your Website)'
      ));

    $external_link = $field->addUrl('external_link')
      ->setLogic('link_type','external');

    $internal_link = $field->addPostObject('internal_link',true)
      ->setLogic('link_type','internal');

    $section_link = $field->addText('section_link',true)
      ->setLabel('Section Name')
      ->setPlaceholder('contact')
      ->setLogic('link_type','section');

    $file = $field->addFile('file_link',true)
      ->setLogic('link_type','file')
      ->setReturnFormat('url');

    $link_fields = array(
      $external_link,
      $internal_link,
      $section_link,
      $file
    );

    foreach ($link_fields as $link_field) {
      $link_field->setWidth('60%');
    }

    return $this->addField($field);

  }

  function addCheckbox($name) {

    $field = new Fields\Checkbox($name);
    return $this->addField($field);

  }

  function addCopy($name='copy') {
    $field = (new Fields\Wysiwyg($name));
    return $this->addField($field);
  }

  // Adds an email field

  function addEmail($name='email') {

    $field = (new Fields\Email($name));
    return $this->addField($field);

  }

  // Adds a field field

  function addFile($name) {

    $field = (new Fields\File($name));
    return $this->addField($field);

  }

//   function addGoogleMap($name) {
//   $field = (new Fields\GoogleMap($name));
//   return $this->addField($field);
// }

  // function addFlexibleContent($name,$chain=true) {
  //   $field = (new Fields\FlexibleContent($name));
  //   return $this->addField($field);
  // }


  // Adds a group field

  function addGroup($name) {

    $field = new Fields\Group($name);
    return $this->addField($field);

  }

  // Adds a headline field

  function addHeadline($name='headline') {

    $field = (new Fields\Text($name))
      ->setMaxLength(100);

    return $this->addField($field);

  }

  // Adds an image field

  function addImage($name='image') {

    $field = (new Fields\Image($name));
    return $this->addField($field);

  }

  // Adds a select field

  function addSelect($name) {

    $field = new Fields\Select($name);
    return $this->addField($field);

  }

  function addMessage($label,$message) {

    // Give the field a unique name (arbitrary)
    $name = $this->getName() . '_message_' . count($this->fields);

    $field = (new Fields\Message($name))
      ->setLabel($label)
      ->setMessage($message);

    return $this->addField($field);

  }

  // Adds a number field

  function addNumber($name) {

    $field = (new Fields\Number($name));
    return $this->addField($field);

  }

  // Adds a post object field

  function addPostObject($name) {

    $field = (new Fields\PostObject($name));
    return $this->addField($field);

  }

  // Adds a range field

  function addRange($name) {

    $field = (new Fields\Number($name))
      ->setType('range');

    return $this->addField($field);

  }

  // Adds a repeater field

  function addRepeater($name) {

    $field = (new Fields\Repeater($name));
    return $this->addField($field);

  }

  // Adds a tab field

  function addTab($name) {

    $field = (new Fields\Tab($name));
    return $this->addField($field);

  }

  // Adds a taxonomy field

  function addTaxonomy($name) {

    $field = (new Fields\Taxonomy($name));
    return $this->addField($field);

  }

  // Adds a text field

  function addText($name) {

    $field = (new Fields\Text($name));
    return $this->addField($field);

  }

  // Adds a textarea field

  function addTextArea($name) {

    $field = (new Fields\TextArea($name));
    return $this->addField($field);

  }

  // Adds a true/false field

  function addTrueFalse($name) {

    $field = (new Fields\TrueFalse($name));
    return $this->addField($field);

  }

  // Adds a url field

  function addUrl($name) {

    $field = (new Fields\Url($name));
    return $this->addField($field);

  }

  // Adds a video field

  function addVideo($name='video') {

    $field = (new Fields\Video($name));
    return $this->addField($field);

  }

  // Adds a WYSIWYG editor field

  function addWysiwyg($name) {

    $field = (new Fields\Wysiwyg($name));
    return $this->addField($field);

  }

  // Adds a prefix to child field keys
  function setPrefix($prefix) {
    if ($prefix === true) {
      $prefix = $this->getKey('raw');
    } elseif ($prefix === false) {
      $prefix = null;
    }

    $this->prefix = $prefix;

    return $this;
  }

  // Sets the field layout
  function setLayout($layout='block') {

    $layouts = array('block','table','row');

    // Sets the layout in the field or group array
    if (in_array($layout,$layouts)) {
      if (property_exists($this,'group')) {$this->group['layout'] = $layout;}
      else {$this->field['layout'] = $layout;}
    }

    return $this;

  }

}
