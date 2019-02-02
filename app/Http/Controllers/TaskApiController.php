<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the Create Task form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCreateTaskForm()
    {
        return view('task');
    }

    /**
     * Store Task.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeTask(Request $request)
    {
        Task::create($request->all());
        return  redirect('home');
    }

    /**
     * Store Task.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeTaskApi(Request $request)
    {
        return Task::create($request->all());
    }

    /**
     * List Task.
     *
     * @return \Illuminate\Http\Response
     */
    public function listTask()
    {
        $taskData =  Task::all();
        return view('list', compact('taskData'));
    }


}
