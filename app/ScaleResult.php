<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScaleResult extends Model
{
    protected $table = "scale_results";
	protected $fillable = [
        'option_answer_id','criterion_id','value' ,'median',
    ];

    public function criterion() {
        return $this->belongsTo(Criterion::class, 'criterion_id');
    }

     public function option_answer() {
        return $this->belongsTo(OptionAnswer::class, 'option_answer_id');
    }

}
