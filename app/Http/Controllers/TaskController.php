<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request, int $id)
    {
        // すべてのフォルダを取得する
        $folders = Folder::all();
        
        // 選ばれたフォルダを取得する
        $current_folder = Folder::find($id);
        
        if ($request->filled('keyword')) {
            $keyword = $request->filled('keyword');
            // タイトルに合致するタスクを取得
            $tasks = Task::where('title', 'like', '%' . $keyword . '%')->get();
        } else {
            // 選ばれたフォルダに紐づくタスクを取得する
            $tasks = $current_folder->tasks()->get();    
        }
        
        $date = date('Y/m/d');
        
        return view('tasks/index', [
                'folders' => $folders,
                'current_folder_id' => $current_folder->id,
                'tasks' => $tasks,
                'date' => $date,
            ]);
    }
    
    /**
     * GET /folders/{id}/tasks/create
     */
    public function showCreateForm(int $id)
    {
        return view('tasks/create', [
            'folder_id' => $id,
            ]);
    }
    
    public function create(int $id, CreateTask $request)
    {
        $current_folder = Folder::find($id);
        
        $task = new Task();
        $task->title = $request->title;
        $task->body = $request->body;
        $task->due_date = $request->due_date;
        
        $current_folder->tasks()->save($task);
        
        return redirect()->route('tasks.index', [
            'id' => $current_folder->id,
            ]);
    }
    
    /**
     * GET /folders/{id}/tasks/{task_id}/edit
     */
    public function showEditForm(int $id, int $task_id)
    {
        $task = Task::find($task_id);
        
        return view('tasks/edit', [
            'task' => $task,
            ]);
    }
    
    public function edit(int $id, int $task_id, EditTask $request)
    {
        // リクエストされたIDでタスクデータを取得
        $task = Task::find($task_id);
        
        // 編集対象のタスクデータに入力値を詰めてsave
        $task->title = $request->title;
        $task->body = $request->body;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();
        
        // 編集対象のタスクが属するタスク一覧画面へリダイレクト
        return redirect()->route('tasks.index', [
            'id' => $task->folder_id,
            ]);
    }
}
