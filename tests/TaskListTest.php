<?php

class TaskListTest extends PHPUnit_Framework_TestCase
{
  private $CI;

  public function setUp()
  {
    $this->CI = &get_instance();
  }

  public function testTaskCompletion()
  {
    $tasks = $this->CI->tasks->all();
    $unfinishedTasks = 0;
    $finishedTasks = 0;

    foreach ($tasks as $task) {
      if ($task->status != 2)
        $unfinishedTasks++;
    }

    foreach ($tasks as $task) {
      if ($task->status == 2)
        $finishedTasks++;
    }

    $this->assertGreaterThan($finishedTasks, $unfinishedTasks);
  }
}
