<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meme extends Model
{
    protected $table = "meme";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    public static function getmeme($id){
        try {
            $res =self::select()->
                where('id',$id)
                ->value('meme');
            //dd($res);
            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('得到失败', [$e->getMessage()]);
            return false;
        }
    }

    public static function showall(){
        try {
            $res =self::select('id','name','meme')
                ->get();
            //dd($res);
            return $res?
                $res:
                false;
        }catch (\Exception $e) {
            logError('得到失败', [$e->getMessage()]);
            return false;
        }
    }



}
