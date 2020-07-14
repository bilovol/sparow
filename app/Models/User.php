<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject //, MustVerifyEmail
{
    use Notifiable;

    protected $fillable = ['id', 'donor_info', 'sp_user_info', 'lang'];
    protected $hidden = ['donor_id', 'donor_access', 'sp_refresh_token', 'status', 'updated_at'];
    protected $casts = [
        'donor_access' => 'array',
        'donor_info' => 'array',
        'sp_user_info' => 'array',
    ];

    protected $appends = ['photo_url', 'is_sp_connect'];

    /**
     * Get the profile photo URL attribute.
     *
     * @return string
     */
    public function getPhotoUrlAttribute()
    {
        return 'https://www.gravatar.com/avatar/' . md5(strtolower($this->sp_user_info['email'] ?? 'undefined')) . '.jpg?s=180&default=mp';
    }


    public function getIsSpConnectAttribute()
    {
        return !empty($this->sp_refresh_token);
    }

    /**
     * @return int
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function automations()
    {
        return $this->hasMany('App\Models\Automation');
    }
}
