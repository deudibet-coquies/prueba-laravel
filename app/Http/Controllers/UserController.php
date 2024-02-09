<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;


class UserController extends Controller
{
    public function consumeApi()
    {
        $usersController = app(UsersController::class);
        $response = $usersController -> index();
        return view('vista', ['data' => $response]);
    }
}
