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
    $this->task = $value;
  }

  public function setPriority($value)
  {
    $this->priority = $value;
  }

  public function setSize($value)
  {
    $this->size = $value;
  }

  public function setGroup($value)
  {
    $this->group = $value;
  }
}