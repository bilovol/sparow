<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository
{
    public function getModel(): Model
    {
        return User::getModel();
    }

    public function getByDonorId($donorId, $columns = ['*'])
    {
       return $this->model->where('donor_id', $donorId)->firstOrFail($columns);
    }
}
