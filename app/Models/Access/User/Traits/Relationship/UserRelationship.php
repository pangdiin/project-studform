<?php

namespace App\Models\Access\User\Traits\Relationship;

use App\Models\Access\User\SocialLogin;
use App\Models\Access\User\Profile;
use App\Models\Order\Order;
use App\Models\Subscribe\Subscribe;

/**
 * Class UserRelationship.
 */
trait UserRelationship
{
    /**
     * Many-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(config('access.role'), config('access.role_user_table'), 'user_id', 'role_id');
    }


    /**
     * @return mixed
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);   
    }

    /**
     * @return mixed
     */
    public function providers()
    {
        return $this->hasMany(SocialLogin::class);
    }

}
