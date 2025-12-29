<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function getAll(): Collection
    {
        return User::latest()->get();
    }

    public function create(array $data): User
    {
        if (isset($data['profile_image'])) {
            $file = $data['profile_image'];
            $fileName = 'user_' . time() . '.' . $file->getClientOriginalExtension();

            $data['profile_image'] = $file->storeAs(
                'users',
                $fileName,
                'public'
            );
        }

        return User::create($data);
    }

    public function updateById(int $id, array $data): User
    {
        $user = User::findOrFail($id);

        if (isset($data['profile_image'])) {
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            $file = $data['profile_image'];
            $fileName = 'user_' . time() . '.' . $file->getClientOriginalExtension();

            $data['profile_image'] = $file->storeAs(
                'users',
                $fileName,
                'public'
            );
        }

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return $user;
    }

    public function findById(int $id): User
    {
        return User::findOrFail($id);
    }

    public function deleteById(int $id): void
    {
        $user = User::findOrFail($id);

        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
        }

        $user->delete();
    }
}
