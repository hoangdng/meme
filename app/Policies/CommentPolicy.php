<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;
  
    // user can update their own comments
    public function update(Account $account, Comment $comment)
    {
        return $account->username === $comment->username;
    }

    //admin can delete any comments, user can delete their own comments
    public function delete(Account $account, Comment $comment)
    {
        return $account->username === $comment->username || $account->isAdmin();
    }
}
