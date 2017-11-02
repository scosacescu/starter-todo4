<?php

use PHPUnit\Framework\TestCase;
require '../application/entities/Task.php';

class TaskTest extends TestCase
{
  private $testTask;

  public function setUp()
  {
    $this->testTask = new Task();
  }

  public function testTaskEntity()
  {
    $taskSet = $this->testTask->setTask('hello');
    $sizeSet = $this->testTask->setSize(3);
    $prioritySet = $this->testTask->setPriority(3);
    $groupSet = $this->testTask->setGroup(3);

    $this->assertTrue($taskSet);
    $this->assertTrue($sizeSet);
    $this->assertTrue($groupSet);
    $this->assertTrue($prioritySet);
  }

  public function testTaskEntityFailure()
  {
    $taskSet = $this->testTask->setTask('');
    $sizeSet = $this->testTask->setSize(6);
    $prioritySet = $this->testTask->setPriority(6);
    $groupSet = $this->testTask->setGroup(6);

    $this->assertFalse($taskSet);
    $this->assertFalse($sizeSet);
    $this->assertFalse($groupSet);
    $this->assertFalse($prioritySet);
  }
}
