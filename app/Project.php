<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{  

     protected $fillable = [
        'user_id','scale_id','objetivo_pesquisa', 'objeto_pesquisa','desempenho','option','data_inicio','data_fim','steps',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scale(){
        return $this->belongsTo(Scale::class);
    }
}
