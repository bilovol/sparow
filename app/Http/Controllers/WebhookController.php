<?php

namespace App\Http\Controllers;

use App\Jobs\Export;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class WebhookController extends Controller
{
    public function index()
    {


        $user = (new UserRepository())->get(2);




        $event = 'order_update';
        $mapping = [];
        $meta = ['book_id' => 1];
        dispatch((new Export($user, $event, $mapping, $meta))->onQueue(env('APP_NAME') . 'Export'));

        return $this->response('Pushed into queue');
    }
}
