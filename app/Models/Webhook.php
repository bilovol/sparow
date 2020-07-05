<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Webhook extends Model
{
    protected $table = 'webhooks';
    protected $fillable = ['id', 'user_id', 'source', 'hash', 'status', 'meta'];
    protected $casts = ['meta' => 'array'];


    /**
     * Statuses
     */
    public const STATUS_DISABLE = 0;
    public const STATUS_ACTIVE = 1;

    /**
     * Types webhook
     * todo правим под себя относительно того какие типи сушностей будет обслужывать вебхук
     */
    public const TYPE_ORDER = 'order'; //new order
    public const TYPE_USER = 'user'; //new user


    public function automations()
    {
        return $this->hasMany('App\Models\Automation');
    }


}

