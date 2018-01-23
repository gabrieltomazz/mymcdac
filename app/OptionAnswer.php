<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionAnswer extends Model
{
    protected $fillable = [
        'project_id','answer',
    ];

    // public function project(){
    //     return $this->belongsTo(Project::class);
    // }
}
