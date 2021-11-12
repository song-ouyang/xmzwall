<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{

    protected $table = "share";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    public static function share($id,$text,$picture_id)
    {
        try {
            $res = self::create([
                'form_id' => $id,
                'text' => $text,
                'picture_id'=>$picture_id
            ]);
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('分享失败', [$e->getMessage()]);
            return false;
        }
    }


    public static function showall(){
        try {
            $res =self::select()->get();
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('分享失败', [$e->getMessage()]);
            return false;
        }

    }

}

