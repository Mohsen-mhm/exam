<?php

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function deleteUser($user)
    {
        return $user->deleteUser($user);
    }

    public function storeUser($data)
    {
        return User::storeUser($data);
    }

    public function updateUser($data, $user)
    {
        return User::updateUser($data, $user);
    }

    public function saveAvatar($image)
    {
        $avatarName = time() . '-' . mt_rand(11111, 99999) . '.' . $image->getClientOriginalExtension();
        $path = 'images/' . $avatarName;
        Storage::disk('public')->put($path, file_get_contents($image));

        return $avatarName;
    }
}
