<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Love extends Model
{
    protected $table = "love";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    public static function add ($form_id,$picture_id,$text,$statue,$gongkai){
        try {
            $res= self::create([
                'form_id'=>$form_id,
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

    public static function change($id)
    {
        try {
            $res = self::where('id', $id)
                ->update([
                    'gongkai' => "1"
                ]);
            //dd($res);
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('更改不成功', [$e->getMessage()]);
            return false;
        }
    }
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

}
