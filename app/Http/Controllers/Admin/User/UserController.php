<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Models\User;
use App\Services\Admin\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.users.create');
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
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'superuser' => $request->superuser,
        ];

        if ($request->avatar) {
            $image = $request->file('avatar');
            $avatarName = $userService->saveAvatar($image);
            $validData['avatar'] = $avatarName;
        }

        $status = $userService->storeUser($validData);

        if ($status)
            return redirect()->route('admin.users.index')->with('success', 'Created successfully.');
        else
            return redirect()->back()->withErrors('Unable to create user...!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
            return redirect()->back()->with('success', 'Deleted successfully.');
        else
            return redirect()->back()->withErrors('Unable to delete user...!');
    }
}
