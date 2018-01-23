<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criterion extends Model
{
    protected $table = "criterions";
	protected $fillable = [
        'project_id','criterion_id', 'name','percent','sequence','title',
    ];

    public function node() {
        return $this->belongsTo(Criterion::class, 'criterion_id');
    }

     public function project() {
        return $this->belongsTo(Project::class, 'project_id');
    }


}
