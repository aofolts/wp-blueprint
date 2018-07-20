<?php

namespace Blueprint\Acf;

class LogicBuilder {

  protected $key;
  protected $ruleGroups;

  function __construct($key) {
    $this->key = $key;
    $this->ruleGroups = array();
  }

  // Adds a rule group
  function addRuleGroup() {
    $group = new RuleGroup($this->key);
    array_push($this->ruleGroups,$group);

    return $group;
  }

  // Returns a conditional logic array
  function getLogic() {
    $logic = array();

    foreach ($this->ruleGroups as $group) {
      array_push($logic,$group->getRules());
    }

    return $logic;
  }

}

class RuleGroup {

  protected $key;
  protected $rules;

  function __construct($key) {
    $this->rules = array();
    $this->key = $key;
  }

  // Adds a rule
  function addRule($field,$value,$operator='==') {
    // Scope key to parent
    if ($this->key) {
      $field = $this->key . $field;
    }

    // Validate $field format
    if (strpos($field,'field_') !== 0) {
      $field = 'field_' . $field;
    }

    // Convert bool to int-based bool
    if (is_bool($value)) {
      $value = (int) $value;
    }

    array_push(
      $this->rules,
      array(
        'field' => $field,
        'value' => $value,
        'operator' => $operator
      )
    );
  }

  // Returns an array of rules
  function getRules() {
    return $this->rules;
  }

}
