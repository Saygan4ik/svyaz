<?php

namespace App\Policies;

use App\Comment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(User $user) {
        return Auth::check();
    }

    public function update(User $user, Comment $comment) {
        return $user->id === $comment->user_id;
    }

    public function before($user, $ability)
    {
        if ($user->isAdmin) {
            return true;
        }
    }
}
