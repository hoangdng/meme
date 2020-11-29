<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\Vote;
use Illuminate\Auth\Access\HandlesAuthorization;

class VotePolicy
{
    use HandlesAuthorization;

    // user can update their own votes
    public function update(Account $account, Vote $vote)
    {
        return $account->username === $vote->username;
    }

    // user can delete their own votes
    public function delete(Account $account, Vote $vote)
    {
        return $account->username === $vote->username;
    }
}
