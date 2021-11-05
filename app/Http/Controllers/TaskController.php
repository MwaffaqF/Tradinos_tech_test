<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Category;
use App\Models\Sub_task;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Task::orderBy('created_at', 'DESC')->paginate(5);

        return view('task.home',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::get();
        $data['assignees'] = User::get();

        return view('task.create',compact('data'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {

        $task = new Task();
        $task->description = $request['description'];
        $task->deadline = $request['deadline'];
        $task->assign = $request['assign'];
        $task->save();
        $task->categories()->attach($request['category']);

        $taskId = $task->id;
        foreach ($request['sub_task'] as $item)
        {
            if($item != null)
            {
                $subTask = new Sub_task();
                $subTask->description = $item;
                $subTask->task_id = $taskId;
                $subTask->save();
            }
        }
        return redirect('tasks/'.$task->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Task::with('categories','subTasks','assignee')->where('id', $id)->first();
        return view('task.show',compact('data'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['categories'] = Category::get();
        $data['assignees'] = User::get();
        $data['task'] = Task::where('id', $id)->first();

        return view('task.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::find($id);
        $task->description = $request['description'];
        $task->deadline = $request['deadline'];
        $task->assign = $request['assign'];
        $task->update();
        $task->categories()->sync($request['category']);

        $taskId = $task->id;

        Sub_task::where('task_id', $id)->delete();

        foreach ($request['sub_task'] as $item)
        {
            if($item != null)
            {
                $subTask = new Sub_task();
                $subTask->description = $item;
                $subTask->task_id = $id;
                $subTask->save();
            }
        }
        return redirect('tasks/'.$task->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::where('id', $id)->delete();

        return redirect('tasks');
    }

    public function get_tasks(Request $request)
    {
        if($request->ajax())
        {
            $query = Task::orderBy('created_at', 'DESC');
            if($request['search'] != null){
                $query = $query->where('description' , 'like', '%' . $request['search'] . '%');
            }
            if($request['id'] != null){
                $query = $query->where('id' , $request['id']);
            }
            if ($request['deadline'] != null) {
                $query = $query->where('deadline', $request['deadline']);
            }
            if ($request['created_from'] != null && $request['created_to']) {
                $query = $query->whereBetween('created_at', [date('Y-m-d H:i:s', strtotime($request['created_from'])),date('Y-m-d H:i:s', strtotime($request['created_to']))]);
            }
            $data = $query->paginate(5);
            return view('tasks_rows', compact('data'))->render();
        }
    }


}
