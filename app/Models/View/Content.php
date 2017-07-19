<?php 

namespace App\Models\View;

use Illuminate\Database\Eloquent\Model;

use App\Models\Image;

class Content extends Model 
{
    protected $table = "view_contents";

    protected $fillable = [
        'view_id', 'type', 
    ];

    public function view()
    {
        return $this->belongsTo(View::class);
    }

    public function criterias()
    {
    	return $this->hasMany(Criteria::class);
    }

}
