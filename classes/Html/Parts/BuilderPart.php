<?php

namespace Blueprint\Html\Parts;

use \Blueprint\Html\Traits as Traits;

/**
 * A part class with access to all builder methods
 *
 *
 */

class BuilderPart extends Part {

  // Imports all builder methods
  use Traits\Builders\Master;

}
