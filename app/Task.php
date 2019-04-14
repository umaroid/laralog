<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * 状態定義
     */
    const STATUS = [
        1 => ['label' => '未処理', 'class' => 'label-danger'],
        2 => ['label' => '処理中', 'class' => 'label-primary'],
        3 => ['label' => '処理済み', 'class' => 'label-info'],
        4 => ['label' => '完了', 'class' => 'label-success'],
        ];
    
    protected $fillable = [
        'title',
        'body',
        ];
    
    /**
     * 状態のラベル
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        // 状態値
        $status = $this->attributes['status'];
        
        // 定義されていなければ空文字を返す
        if (!isset(self::STATUS[$status]))
        {
            return '';
        }
        
        return self::STATUS[$status]['label'];
    }
    
      /**
     * 状態を表すHTMLクラス
     * @return string
     */
    public function getStatusClassAttribute()
    {
        // 状態値
        $status = $this->attributes['status'];
        
        // 定義されていなければ空文字を返す
        if (!isset(self::STATUS[$status]))
        {
            return '';
        }
        
        return self::STATUS[$status]['class'];
    }
    
    /**
     * 整形した期限日
     * @return string
     */
    public function getFormattedDueDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['due_date'])->format('Y/m/d');
    }
    
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
