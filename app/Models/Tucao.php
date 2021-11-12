<?php

namespace App\Models;

use Closure;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class Tucao extends Model
{
    protected $table = "tucao";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    /***
     * yjx
     * 添加吐槽
     * @param $id
     * @param $picture_id
     * @param $text
     * @param $statue
     * @param $gongkai
     * @return false
     */
    public static function add ($id,$picture_id,$text,$statue,$gongkai){
        try {
            $res= self::create([
                'form_id'=>$id,
                'picture_id'=>$picture_id,
                'text'=>$text,
                'statue'=>$statue,
                'gongkai'=>$gongkai
            ]);
            //dd($res);
            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('插入不成功', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * yjx
     * 改变公开为1
     * @param $id
     * @return false
     *
     */
    public static function change($id){
        try {
            $res= self::where('id',$id)
            ->update([
                'gongkai'=>1
            ]);
            //dd($res);
            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('更改不成功', [$e->getMessage()]);
            return false;
        }

    }

    /***
     * yjx
     * 点赞
     * @param $id
     * @return false
     */
    public static function addzan($id){
        try {
            $res1 = self::where('id',$id)->value('praise_number');
            $res =self::select()->
            where('id',$id)->update([
                'praise_number'=> $res1+1
            ]);

            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('点赞失败', [$e->getMessage()]);
            return false;
        }
    }

    /***
     * yjx
     * 得到一条吐槽id
     * @param $form_id
     * @param $text
     * @return false
     */
    public static function getidd($form_id,$text){
        try {
            $res = self::select()
                ->where('form_id',$form_id)
                ->where('text',$text)
                ->value('id');
            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('得到id失败', [$e->getMessage()]);
            return false;
        }

    }

    /**
     * yjx
     * 展示全部
     * @return false
     *
     */
    public static function showall(){
        try {
            $res = self::select()
                ->get();
            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('得到所有失败', [$e->getMessage()]);
            return false;
        }
    }

    /***
     * yjx
     * 得到一条吐槽
     * @param $form_id
     * @param $text
     * @param $picture_id
     * @return false
     */
    public static function show($form_id,$text,$picture_id){
        try {
            $res= self::where('picture_id',$picture_id)
                ->where('form_id',$form_id)
                ->where('text',$text)
                ->get();
            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('得到失败', [$e->getMessage()]);
            return false;
        }
}

  /*
public static function showtucaoid($form_id,$text,$picture_id){
        try {
            $res= self::where('picture_id',$picture_id)
                ->get();
            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('得到失败', [$e->getMessage()]);
            return false;
        }
    }*/

    /***
     * yjx
     * 添加评论数量
     * @param $id
     * @return false
     */
    public static function addcommentnum($id){
        try {
            $comment_number = self::where('id',$id)
                ->value('comment_number');
            $res1 = $comment_number+1;
            $res= self::
            where('id',$id)
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

    /***
     * yjx
     * 添加分享数量
     * @param $id
     * @return false
     */
    public static function addsharenum($id){
        try {
            $share_number = self::
            where('id',$id)->
            value('share_number');
            $res1 = $share_number+1;
            $res= self::where('id',$id)
                ->update([
                    'share_number'=>$res1,
                ]);
            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('得到失败', [$e->getMessage()]);
            return false;
        }

    }

    /***
     * yjx
     * 添加收藏数量
     * @param $id
     * @return false
     */
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


}
