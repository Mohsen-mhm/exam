<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Dashboard\UpdateProfileRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function updateProfile(UpdateProfileRequest $request)
    {
        return $request->all();
    }
}
