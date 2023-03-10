<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\StoreUserRequest;
use App\Http\Requests\Admin\Users\UpdateUserRequest;
use App\Models\User;
use App\Services\Admin\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%');
        })
            ->orderBy('name')
            ->paginate(10);

        $breadcrumb = [
            ['name' => 'Dashboard', 'route' => route('admin.home')],
            ['name' => 'Users', 'route' => route('admin.users.index')],
        ];

        return view('admin.users.index', compact('users', 'breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $breadcrumb = [
            ['name' => 'Dashboard', 'route' => route('admin.home')],
            ['name' => 'Users', 'route' => route('admin.users.index')],
            ['name' => 'Create', 'route' => route('admin.users.create')],
        ];

        return view('admin.users.create', compact('breadcrumb'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request, UserService $userService)
    {
        $validData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'superuser' => $request->input('superuser'),
        ];

        if ($request->avatar) {
            $image = $request->file('avatar');
            $avatarName = $userService->saveAvatar($image);
            $validData['avatar'] = $avatarName;
        }

        $status = $userService->storeUser($validData);

        if ($status)
            return redirect(route('admin.users.index'))->with('success', 'Created successfully.');
        else
            return redirect()->back()->withErrors('Unable to create user...!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $user = User::find($id);

        $breadcrumb = [
            ['name' => 'Dashboard', 'route' => route('admin.home')],
            ['name' => 'Users', 'route' => route('admin.users.index')],
            ['name' => 'Edit'],
        ];

        return view('admin.users.edit', compact('user', 'breadcrumb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request, $id, UserService $userService)
    {
        $user = User::find($id);

        $validData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'superuser' => $request->input('superuser'),
        ];

        if ($request->avatar) {
            $image = $request->file('avatar');
            $avatarName = $userService->saveAvatar($image);
            $validData['avatar'] = $avatarName;
        }

        $status = $userService->updateUser($validData, $user);

        if ($status)
            return redirect(route('admin.users.index'))->with('success', 'Edited successfully.');
        else
            return redirect()->back()->withErrors('Unable to edit user...!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, UserService $userService)
    {
        $user = User::findOrFail($id);
        $status = $userService->deleteUser($user);

        if ($status)
            return redirect(route('admin.users.index'))->with('success', 'Deleted successfully.');
        else
            return redirect()->back()->withErrors('Unable to delete user...!');
    }
}
