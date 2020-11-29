<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;
  
    //admin can update any posts, user can update their own posts
    public function update(Account $account, Post $post)
    {
        return $account->username === $post->username || $account->isAdmin();
    }

    //admin can delete any posts, user can delete their own posts
    public function delete(Account $account, Post $post)
    {
        return $account->username === $post->username || $account->isAdmin();
    }
}
