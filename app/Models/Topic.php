<?php

namespace App\Models;

use Closure;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = "topic";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    public static function gettopic($id){
        try {
            $res =self::select()->
            where('id',$id)
                ->value('topic');
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
            $res =self::select('id','topic')
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
