<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


use App\Task;
use Illuminate\Http\Request;

/**
 * Display All Tasks
 */
Route::get('/{name}', function($name) {
  echo "xin chao " . $name;
});

Route::get('/', function () {
  $tasks = Task::orderBy('created_at', 'desc')->get();

  return view('tasks', ['tasks' => $tasks]);
});

/**
 * Add A New Task
 */
Route::post('/task', function (Request $request) {
  $validator = Validator::make($request->all(), [
    'name' => 'required|max:15',
  ]);

  if ($validator->fails()) {
    return redirect('/')
      ->withInput()
      ->withErrors($validator);
  }

  $task = new Task;
  $task->name = $request->name;
  $task->save();

  return redirect('/');
});

/**
 * Delete An Existing Task
 */
Route::delete('/task/{id}', function ($id) {
  Task::findOrFail($id)->delete();

  return redirect('/');
});
