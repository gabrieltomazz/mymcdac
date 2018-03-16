<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SortLastCriteria extends Model
{
    protected $table = "sort_last_criteria";
	protected $fillable = [
        'project_id','criterion_id', 'order',
    ];

    public function criterion() {
        return $this->belongsTo(Criterion::class, 'criterion_id');
    }

     public function project() {
        return $this->belongsTo(Project::class, 'project_id');
    }


}
