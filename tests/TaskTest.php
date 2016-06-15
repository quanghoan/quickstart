<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TaskTest extends TestCase
{
  /**
   * A basic test example.
   *
   * @return void
   */
  public function testExample()
  {
    $this->assertTrue(true);
  }

  public function testIndex()
  {
    $this->visit('/')->see('Task');
    $this->assertViewHas('tasks');
  }

  public function testInvalidTask()
  {
    $response = $this->call('POST', '/', ['name ' => "this is too long name of task"]);
    $this->assertFalse(false);
  }

  public function testBlankTask()
  {
    $response = $this->call('POST', '/', ['name ' => ""]);
    $this->assertFalse(false);
  }

  public function testValidTask()
  {
    $response = $this->call('POST', '/task', [
      'name' => 'valid test'
      ]);
    $this->seeInDatabase('tasks', ['name' => 'valid test']);
  }

  public function testDeleteTask()
  {
    $response = $this->call('DELETE', '/task/10');
    $this->notSeeInDatabase('tasks', ['id' => 10]);
  }
}