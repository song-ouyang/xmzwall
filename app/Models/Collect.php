<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collect extends Model
{
    protected $table = "collect";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];


    public static function collect($form_id1,$text,$praise_number,$collect_number,$share_number,$comment_number)
    {
        try {
            $res = self::create([
                'form_id' => $form_id1,
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

    public static function addcollectnum($id){
        try {
            $collect_number = self::
            where('id',$id)->
            value('collect_number');

            $res1 = $collect_number+1;
            $res= self::where('id',$id)
                ->update([
                    'collect_number'=>$res1,
                ]);
            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('增加收藏数失败', [$e->getMessage()]);
            return false;
        }
    }

    public static function addcommentnum($form_id,$title){
        try {
            $comment_number = self::where('form_id',$form_id)->where('title',$title)->value('commnet_number');
            $res1 = $comment_number+1;
            $res= self::where('title',$title)->
            where('form_id',$form_id)
                ->update([
                    'comment_number'=>$res1,
                ]);
            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('增加评论数失败', [$e->getMessage()]);
            return false;
        }
    }

}
