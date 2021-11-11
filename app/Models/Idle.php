<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Idle extends Model
{
    protected $table = "idle";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    public static function add($id, $picture_id, $text, $statue, $price)
    {
        try {
            $res = self::create([
                'form_id' => $id,
                'picture_id' => $picture_id,
                'text' => $text,
                'statue' => $statue,
                'price' => $price
            ]);
            //dd($res);
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('插入不成功', [$e->getMessage()]);
            return false;
        }
    }

    public static function addzan($id)
    {
        try {
            $res1 = self::where('id', $id)->value('praise_number');
            $res = self::select()->
            where('id', $id)->update([
                'praise_number' => $res1 + 1
            ]);

            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('点赞失败', [$e->getMessage()]);
            return false;
        }
    }

    public static function getidd($form_id, $text)
    {
        try {
            $res = self::select()
                ->where('form_id', $form_id)
                ->where('text', $text)
                ->value('id');
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('得到id失败', [$e->getMessage()]);
            return false;
        }

    }

    public static function showall()
    {
        try {
            $res = self::select()
                ->get();
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('得到所有失败', [$e->getMessage()]);
            return false;
        }


    }

    /***
     * yjx
     * 得到一条闲置
     * @param $form_id
     * @param $text
     * @param $picture_id
     * @return false
     */
    public static function show($form_id, $text, $picture_id)
    {
        try {
            $res = self::where('picture_id', $picture_id)
                ->where('form_id', $form_id)
                ->where('text', $text)
                ->get();
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('得到失败', [$e->getMessage()]);
            return false;
        }
    }

    /***
     * yjx
     * 增加收藏数量
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
