<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Automation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class AutomationRepository extends BaseRepository
{
    public function getModel(): Model
    {
        return Automation::getModel();
    }

    /**
     * @param array|string[] $columns
     * @return Paginator
     */
    public function list(array $columns = ['*']): Paginator
    {
        return $this->model
            ->where('automations.user_id', Auth::user()->id)
            ->leftJoin('webhooks', 'webhooks.id', '=', 'automations.webhook_id')->paginate($this->model->getPerPage(), $columns);
    }


    /**
     * @param $id
     * @param array|string[] $columns
     * @return AutomationRepository|AutomationRepository[]|\Illuminate\Database\Eloquent\Builder[]|Collection|Model|Model[]
     */
    public function get($id, array $columns = ['*'])
    {
        return $this->model
            ->where('automations.id', $id)
            ->where('automations.user_id', Auth::user()->id)
            ->leftJoin('webhooks', 'webhooks.id', '=', 'automations.webhook_id')
            ->firstOrFail($columns);
    }

    public function update($id, array $attributes = [], array $options = [])
    {
        return $this->model->where('id', $id)
            ->where('user_id', Auth::user()->id)
            ->update($attributes);
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function getCountByWebhookId($webhookId)
    {
        return $this->model->where('webhook_id', $webhookId)->count();
    }
}
