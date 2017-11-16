<?php

class XML_Model extends Memory_Model
{

  function __construct($origin = null, $keyfield = 'id', $entity = null)
  {
    parent::__construct();

    // guess at persistent name if not specified
    if ($origin == null)
      $this->_origin = get_class($this);
    else
      $this->_origin = $origin;

    // remember the other constructor fields
    $this->_keyfield = $keyfield;
    $this->_entity = $entity;

    // start with an empty collection
    $this->_data = array(); // an array of objects
    $this->fields = array(); // an array of strings
    // and populate the collection
    $this->load();
  }

  protected function load()
  {
    if (file_exists($this->_origin)) {
      $xml = simplexml_load_file($this->_origin);
      $tasks = $xml->children();

      foreach ($tasks as $task){
        $taskArray = (array)$task;
        $taskKeys = array_keys($taskArray);
        $record = new stdClass();
        foreach($taskKeys as $taskKey){
          $record->{$taskKey} = (string)$taskArray[$taskKey];
        }
        $key = $record->{$this->_keyfield};

        $this->_data[$key] = $record;
      }
    }
    // --------------------
    // rebuild the keys table
    $this->reindex();
  }

  protected function store()
  {
    $xmlstr =
      '<?xml version="1.0" encoding="UTF-8"?>
      <tasks>
      </tasks>
      ';
    $this->reindex();
    //---------------------
    if (file_exists($this->_origin)) {
      $tasks = new SimpleXMLElement($xmlstr);
      foreach($this->_data as $key => $record){
        $task = $tasks->addChild('task');
        $taskArray = (array)$record;
        $taskKeys = array_keys($taskArray);
        foreach($taskKeys as $taskKey){
          $task->addChild((string)$taskKey, (string)$taskArray[$taskKey]);
        }
      }
      $tasks->asXML($this->_origin);
    }
  }
}
