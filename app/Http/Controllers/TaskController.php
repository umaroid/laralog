<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * タスク一覧
     * @param Folder $folder
     * @return \Illuminate\View\View
     */
    public function index(Request $request, Folder $folder)
    {
        // ユーザーのフォルダを取得する
        $folders = Auth::user()->folders()->get();
        
        // 値がリクエストに存在しており、かつ空でないことを判定したい場合
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            // タイトルに合致するタスクを取得
            $tasks = Task::where('title', 'like', '%' . $keyword . '%')->where('folder_id', $folder->id)->paginate(10);
        } else {
            // 選ばれたフォルダに紐づくタスクを取得する
            $tasks = $folder->tasks()->paginate(10);
        }
        
        $date = date('Y/m/d');
        
        $all_tasks_count = $folder->tasks()->count();
        $task_status_1 = Task::where('status', 1)->where('folder_id', $folder->id)->count();
        $task_status_2 = Task::where('status', 2)->where('folder_id', $folder->id)->count();
        $task_status_3 = Task::where('status', 3)->where('folder_id', $folder->id)->count();
        $task_status_4 = Task::where('status', 4)->where('folder_id', $folder->id)->count();
        
        return view('tasks/index', [
                'folders' => $folders,
                'current_folder_id' => $folder->id,
                'tasks' => $tasks,
                'date' => $date,
                'all_tasks_count' => $all_tasks_count,
                'task_status_1' => $task_status_1,
                'task_status_2' => $task_status_2,
                'task_status_3' => $task_status_3,
                'task_status_4' => $task_status_4,
            ]);
    }
    
    /**
     * タスク作成フォーム
     * @param Folder #folder
     * @return \Illuminate\View\View
     */
    public function showCreateForm(Folder $folder)
    {
        return view('tasks/create', [
            'folder_id' => $folder->id,
            ]);
    }
    
    /**
     * タスク作成
     * @param Folder $folder
     * @param CreateTask $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Folder $folder, CreateTask $request)
    {
        $task = new Task();
        $task->title = $request->title;
        $task->body = $request->body;
        $task->due_date = $request->due_date;
        
        $folder->tasks()->save($task);
        
        return redirect()->route('tasks.index', [
            'id' => $folder->id,
            ]);
    }
    
    /**
     * タスク編集フォーム
     * @param Folder $folder
     * @param Tsk $task
     * @return \Illuminate\View\View
     */
    public function showEditForm(Folder $folder, Task $task)
    {
        $this->checkRelation($folder, $task);
        
        return view('tasks/edit', [
            'task' => $task,
            ]);
    }
    
    /**
     * タスク編集
     * @param Folder $folder
     * @param Task $task
     * @param EditTask $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Folder $folder, Task $task, EditTask $request)
    {
        $this->checkRelation($folder, $task);
        
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
    
    private function checkRelation(Folder $folder, Task $task)
    {
        if ($folder->id !== $task->folder_id) {
            abort(404);
        }
    }
}
