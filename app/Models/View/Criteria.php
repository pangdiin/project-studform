<?php 

namespace App\Models\View;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model 
{
    protected $table = "view_criterias";

    protected $fillable = [
        'view_id', 'content_id', 'field', 'condition', 'comparison' 
    ];

    public function view()
    {
        return $this->belongsTo(View::class);
    }

    public function content()
    {
    	return $this->belongsTo(Criteria::class);
    }

}
