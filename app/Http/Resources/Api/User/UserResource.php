<?php
declare(strict_types=1);

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $user = ($this->resource && !\is_array($this->resource))
            ? $this->resource->toArray() : (\is_array($this->resource) ? $this->resource : []);

        if ($user) {
            unset(
                $user['donor_access'],
                $user['sp_refresh_token'],
                $user['updated_at'],
            );
        }

        return $user;
    }

}
