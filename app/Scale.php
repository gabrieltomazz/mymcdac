<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scale extends Model
{
    protected $fillable = [
        'user_id','description',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function optionAnswer(){
        return $this->hasMany(OptionAnswer::class);
    }
}
