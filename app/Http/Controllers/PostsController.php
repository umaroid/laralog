<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Http\Requests\CreatePost;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Folder $folder)
    {
        //$posts = Post::all();
        
        // ユーザーのフォルダを取得する
        $folders = Auth::user()->folders()->get();
        
        // ユーザーのフォルダを取得する
        $posts = Post::where('user_id', $folder->user_id)->get();
        
        return view('posts/index', [
            'posts' => $posts,
            'current_folder_id' => $folder->id,
            ]);
    }
    
    /**
     * Wiki作成フォーム
     * @param Folder #folder
     * @return \Illuminate\View\View
     */
    public function showCreateForm(Folder $folder)
    {
        return view('posts/create', [
            'folder_id' => $folder->id,
            ]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Folder $folder, CreatePost $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        //$post->user_id = $request->id;
        
        //$user->post()->save($post);
        //$user->posts()->save($post);
        Auth::user()->posts()->save($post);
        
        return redirect()->route('posts.index', [
            'id' => $folder->id,
            ]);
        
    }
    
    /**
     * タスク編集フォーム
     * @param Folder $folder
     * @param Tsk $task
     * @return \Illuminate\View\View
     */
    public function showEditForm(Folder $folder, Post $post)
    {
        //$this->checkRelation($folder, $post);
        
        return view('posts/edit', [
            'folder_id' => $folder->id,
            'post' => $post,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Folder $folder, Post $post, Request $request)
    {
        //$this->checkRelation($user, $post);
        
        // 編集対象のタスクデータに入力値を詰めてsave
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
        
        // 編集対象のタスクが属するタスク一覧画面へリダイレクト
        return redirect()->route('posts.index', [
            'id' => $folder->id,
            ]);
    }
    
    private function checkRelation(Folder $folder, Post $post)
    {
        /*if ($user->id !== $post->user_id) {
            abort(404);
        }*/
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
