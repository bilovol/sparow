<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Automation
 * @package App\Models
 * @property int id
 * @property int user_id
 * @property int webhook_id
 * @property int workflow
 * @property array meta
 * @property array mapping
 * @property array rule
 * @property int status
 * @property string name
 */
class Automation extends Model
{
    protected $table = 'automations';
    protected $fillable = ['user_id', 'webhook_id', 'workflow', 'meta', 'mapping', 'rule', 'status', 'name'];
    protected $casts = [
        'mapping' => 'array',
        'meta' => 'array',
    ];

    protected $perPage = 2;
}
