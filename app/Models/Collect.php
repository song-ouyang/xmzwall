<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collect extends Model
{
    protected $table = "collect";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];


    public static function collect($form_id,$text,$praise_number,$collect_number,$share_number,$comment_number)
    {
        try {
            $res = self::create([
                'form_id' => $form_id,
                'text' => $text,
                'praise_number' => $praise_number,
                'collect_number' => $collect_number,
                'share_number' => $share_number,
                'comment_number' => $comment_number
            ]);
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('添加收藏失败', [$e->getMessage()]);
            return false;
        }
    }
    public static function collect1($form_id,$text,$praise_number,$collect_number,$share_number,$comment_number,$price)
    {
        try {
            $res = self::create([
                'form_id' => $form_id,
                'text' => $text,
                'praise_number' => $praise_number,
                'collect_number' => $collect_number,
                'share_number' => $share_number,
                'comment_number' => $comment_number,
                'price'=>$price
            ]);
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('添加收藏失败', [$e->getMessage()]);
            return false;
        }
    }
}
