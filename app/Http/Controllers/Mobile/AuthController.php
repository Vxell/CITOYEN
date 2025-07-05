<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AuthRepository;
use App\Http\Requests\AuthLoginRequest;

class AuthController extends Controller
{
    private $authrepository;

    public function __construct(AuthRepository $authrepository)
    {
        $this->authrepository = $authrepository;
    }

    public function register(AuthLoginRequest $request){

        return  $this->authrepository->register($request);
    }

    public function login(Request $request){

        return $this->authrepository->Login($request);
    }

    public function logout(Request $request){

        return $this->authrepository->Logout($request);
    }
}
