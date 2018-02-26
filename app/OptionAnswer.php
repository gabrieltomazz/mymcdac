<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionAnswer extends Model
{
    protected $fillable = [
        'scale_id','answer','neutral','good',
    ];

    public function scale(){
        return $this->belongsTo(Scale::class);
    }
}
