<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Livewire\Component;

class AdminList extends Component
{
    // public function delete(User $admin)
    // {
    //     abort_if(!auth()->user()->is_admin, Response::HTTP_FORBIDDEN, 403);

    //     $admin->delete();
    // }

    // public function render(): View
    // {
    //     $admins = User::admin()->paginate();

    //     return view('livewire.admin.admin-list', [
    //         'admins' => $admins
    //     ]);
    // }
    public function delete(User $user)
    {
        abort_if(!auth()->user()->is_admin, Response::HTTP_FORBIDDEN, 403);

        if ($user->is_admin === 0) {
            $user->delete();
        } else {
            session()->flash('error', 'Admin users cannot be deleted.');
        }
    }

    public function render(): View
    {
        $users = User::paginate();

        return view('livewire.admin.admin-list', [
            'users' => $users
        ]);
    }
}
