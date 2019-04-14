<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    public function tasks()
    {
        // フォルダテーブルとタスクテーブルの関連性を辿って、
        // フォルダクラスのインスタンスから紐づくタスククラスのリストを取得する。
        // return $this->hasMany('App\Task', 'folder_id', 'id');とも書ける
        return $this->hasMany('App\Task');
    }
}
