<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{

    protected $table = "share";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    public static function share($form_id,$text,$picture_id)
    {
        try {
            $res = self::create([
                'form_id' => $form_id,
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


}

