<?php

namespace App\Models\Access\User;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Profile.
 */
class Profile extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'user_id', 'avatar',
    	'first_name', 'last_name',
    	'address', 'contact_number',
    	'card_number', 'card_expire', 'card_cvv',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function getNameAttribute()
    {
    	return $this->first_name . ' ' . $this->last_name;
    }

    public function getImageAttribute()
    {
    	return $this->avatar ? asset($this->avatar) : null;
    }
}

