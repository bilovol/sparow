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
 * @property string source
 * @property boolean is_tracking
 * @property array rule
 * @property int status
 * @property string name
 */
class Automation extends Model
{
    protected $table = 'automations';
    protected $fillable = ['user_id', 'webhook_id', 'workflow', 'meta', 'mapping', 'source', 'is_tracking', 'rule', 'status', 'name'];
    protected $casts = [
        'mapping' => 'array',
        'meta' => 'array',
        'is_tracking' => 'boolean'
    ];

    public const STATUS_DISABLE = 0;
    public const STATUS_ACTIVE = 1;

    public const WORKFLOW_EXPORT = 0;
    public const WORKFLOW_POST = 1;

    public const PER_PAGE = 6;
}
