<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Automation;
use App\Models\Webhook;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;

class WebhookRepository extends BaseRepository
{

    public function getModel(): Model
    {
        return Webhook::getModel();
    }

    public function get($id, array $columns = ['*'])
    {
        return $this->model->where('id', $id)->where('user_id', 1)->firstOrFail($columns);
    }

    public function getBySource($source, array $columns = ['*'])
    {
        return $this->model->where('user_id', 1)->where('source_tag', $source)->first($columns);
    }
}
