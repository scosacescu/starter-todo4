<?php

class Task extends CI_Model
{
  private $task, $priority, $size, $group;

  public function __set($key, $value)
  {
    $method = 'set' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $key)));
    if (method_exists($this, $method)) {
      $this->$method($value);
      return $this;
    }

    // Otherwise, just set the property value directly.
    $this->$key = $value;
    return $this;
  }

  public function setTask($value)
  {
    if (preg_match('/^[A-Z0-9 ]+$/i', $value) && strlen($value) <= 64) {
      $this->task = $value;
    }
  }

  public function setPriority($value)
  {
    if (is_int($value) && $value < 5) {
      $this->priority = $value;
    }
  }

  public function setSize($value)
  {
    if (is_int($value) && $value < 5) {
      $this->size = $value;
    }
  }

  public
  function setGroup($value)
  {
    if (is_int($value) && $value < 6) {
      $this->group = $value;
    }
  }
}