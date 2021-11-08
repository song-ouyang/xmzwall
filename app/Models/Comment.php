<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comment";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    public static function comment($form_id,$title,$reply_id){
        try {
            $res = self::create([
                'form_id' => $form_id,
                'title' => $title,
                'reply_id'=>$reply_id
            ]);
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('评论失败', [$e->getMessage()]);
            return false;
        }
    }

    public static function getid($form_id,$title){
        try {
            $res = self::select()
                    ->where('form_id',$form_id)
                ->where('title',$title)
                ->value('id');
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('查找id失败', [$e->getMessage()]);
            return false;
        }


    }


}
