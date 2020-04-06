<?php

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * Show Task Dashboard
 */
Route::get('/', function () {
    $tasks = Task::all();

    return view('tasks', [
        'tasks' => $tasks,
    ]);
});

/**
 * Add New Task
 */
Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(),[
    	'name' => 'required|max:255',
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
 * Delete Task
 */
Route::delete('/task/{id}', function ($id) {
    Task::findOrFail($id)->delete();

    return redirect('/');
});
