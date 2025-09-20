<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $data['users'] = User::paginate();

        return view('admin.users.index', $data);
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(CreateUserRequest $request): RedirectResponse
    {
        $this->authorizeCreate(User::class);

        $validated = $request->validated();

        $user = new User($validated);
        $user->setAttribute('password', bcrypt('password'));
        $user->save();

        $this->alertSuccess('User created');

        return back();
    }

    public function show(User $user): View
    {
        $data['user'] = $user;

        return view('admin.users.view', $data);
    }

    public function edit(User $user): View
    {
        $data['user'] = $user;

        return view('admin.users.edit', $data);
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $this->authorizeUpdate(User::class);

        $validated = $request->validated();

        $user->update($validated);

        $this->alertSuccess('User updated');

        return back();
    }
}
