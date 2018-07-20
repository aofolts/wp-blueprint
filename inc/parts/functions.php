<?php

use Blueprint\Html\Builders as Builders;
use Blueprint\Html\Parts as Parts;
use Blueprint\Html\Parts\Part as Part;
use Blueprint\Html\Templates\Template as Template;

// Returns a new part class instance

function new_template($name=null) {

  return new Parts\Template($name);

}

// Returns a new template part class instance

function new_template_part($name=null) {

  return new Part($name);

}

// Returns a new template part class instance
// with access to all builder methods
//
// ex. a container that might directly add
// text, images, or other containers, etc

function new_builder_part($name=null) {

  return new Parts\BuilderPart($name);

}

// Returns a new PartBuilder class instance
// with access to all builder methods
//
// PartBuilder is NOT a Part itself,
// and only returns the output from
// its children parts

function new_part_builder() {

  return new Builders\Master();

}

// Returns a new header part
function new_header() {

  return new Parts\Header();

}

// Returns a new footer part
function new_footer() {

  return new Parts\Footer();

}

// Returns a new email template
function new_email_template() 
{
  return new Parts\Emails\Email();
}
