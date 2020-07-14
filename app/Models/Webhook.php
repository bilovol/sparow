<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Webhook extends Model
{
    protected $table = 'webhooks';
    protected $fillable = ['id', 'user_id', 'source_tag', 'hash', 'status', 'meta'];
    protected $casts = ['meta' => 'array'];
}

