<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthSanctumController extends Controller
{
    public function authenticate(Request $request)
    {
        return response([
            'token' => $request->user()->createToken('broadcasting_token')->plainTextToken
        ]);
    }
}
