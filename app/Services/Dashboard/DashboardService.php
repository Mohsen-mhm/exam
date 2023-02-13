<?php

namespace App\Services\Dashboard;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DashboardService
{
    public function updateProfile($data, $user)
    {
        return $user->updateProfile($data, $user);
    }

    public function saveAvatar($image)
    {
        $avatarName = time() . '-' . mt_rand(11111, 99999) . '.' . $image->getClientOriginalExtension();
        $path = 'images/' . $avatarName;
        Storage::disk('public')->put($path, file_get_contents($image));

        return $avatarName;
    }
}
