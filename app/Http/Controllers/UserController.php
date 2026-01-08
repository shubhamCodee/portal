<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {}

    public function index(): Response
    {
        return Inertia::render('Users/Index', [
            'users' => $this->userRepository->getAll(),
        ]);
    }

    public function show(int $id): Response
    {
        $user = $this->userRepository->findById($id);

        $user->load('assignedLeads');

        return Inertia::render('Users/Show', [
            'user' => $user,
        ]);
    }


    public function create(): Response
    {
        return Inertia::render('Users/Create');
    }

    public function edit(int $id): Response
    {
        return Inertia::render('Users/Edit', [
            'user' => $this->userRepository->findById($id),
        ]);
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $this->userRepository->create($request->validated());

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function update(UpdateUserRequest $request, int $id): RedirectResponse
    {
        $this->userRepository->updateById($id, $request->validated());

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->userRepository->deleteById($id);

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
