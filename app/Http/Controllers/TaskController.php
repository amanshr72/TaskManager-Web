<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Notification;
use App\Models\Task;
use App\Models\TaskCategory;
use App\Models\TaskLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function dashboard()
    {
        $categories = TaskCategory::with('tasks')->get();
        return view('dashboard', compact('categories'));
    }

    public function allTaskList(Request $request)
    {
        $categoryId = $request->input('categoryId');

        $categories = TaskCategory::orderBy('name')->get();
        $tasks = Task::with('logs', 'category')->latest();

        if (Auth()->user()->role !== 'ADMIN') {
            $tasks->where('assigned_to', Auth()->user()->id);
        }
        if (isset($categoryId) && $categoryId !== null) {
            $tasks->where('task_category_id', $categoryId);
        }

        $tasks = $tasks->paginate(10);
        $tasks->appends(['categoryId' => $categoryId]);
        return view('task.all-tasks', compact('tasks', 'categories'));
    }

    public function assignedToMe(Request $request)
    {
        $tasks = Task::with('category')->latest();
        if (Auth()->user()->role !== 'ADMIN') {
            $tasks->where('assigned_to', Auth()->user()->id);
        }
        $tasks = $tasks->paginate(10);
        return view('task.index', compact('tasks'));
    }

    public function store(StoreTaskRequest $request)
    {
        Task::create([
            'task_category_id' => $request->task_category,
            'title' => $request->title,
            'description' => $request->description,
            'assigned_by' => auth()->user()->id,
            'assigned_to' => $request->asignee,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'expiration_time' => $request->expiration_time,
            'due_date' => $request->due_date,
            'recurrence' => $request->recurrence,
            'reminder' => $request->reminder,
            'status' => 'Pending',
        ]);

        if ($request->asignee) {
            Notification::create([
                'user_id' => $request->asignee,
                'from_user_id' => Auth::user()->id,
                'message' => $request->title . (isset($request->due_date) ? ' with Due date ' . date('d F Y h:i A', strtotime($request->due_date)) : ''),
            ]);
        }

        return redirect()->route('dashboard');
    }

    public function edit(Task $task)
    {
        $categories = TaskCategory::orderBy('name')->get();
        return view('task.edit', compact('task', 'categories'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required',
            'progress' => 'required',
        ]);
        Task::find($task->id)->update([
            'task_category_id' => $request->task_category,
            'status' => $request->status,
            'progress' => $request->progress,
            'remark' => $request->remark,
            'asignee' => $request->asignee,
        ]);

        if ($request->asignee) {
            Notification::create([
                'user_id' => $request->asignee,
                'from_user_id' => Auth::user()->id,
                'message' =>  $task->title,
            ]);
        }

        TaskLog::create([
            'task_id' => $task->id,
            'status' => $request->status,
            'progress' => $request->progress,
            'remark' => $request->remark
        ]);

        return redirect()->route('task.index')->with('success', 'Task updated');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $tasks = Task::where('title', 'like', '%' . $search . '%')->latest()->get();
        return view('task.dashboard-task-list', compact('tasks'));
    }

    public function filter(Request $request)
    {
        $tasks = Task::where('status', $request->input('status'))->latest()->get();
        return view('task.dashboard-task-list', compact('tasks'));
    }

    public function categoryFilter(Request $request)
    {
        $tasks = Task::where('task_category_id', $request->input('category'))->latest()->get();
        return view('task.dashboard-task-list', compact('tasks'));
    }

    public function markImportant(Task $task)
    {
        $task->update(['is_important' => 1]);
        return redirect()->back();
    }

    public function unmarkImportant(Task $task)
    {
        $task->update(['is_important' => 0]);
        return redirect()->back();
    }
 
    public function importantTask()
    {
        $tasks = Task::where('is_important', true)->latest()->paginate(10);
        return view('task.important', compact('tasks'));
    }
}
