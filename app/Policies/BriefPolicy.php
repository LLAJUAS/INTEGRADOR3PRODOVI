<?php

// app/Policies/BriefPolicy.php
namespace App\Policies;

use App\Models\User;
use App\Models\Brief;

class BriefPolicy
{
    public function view(User $user, Brief $brief)
    {
        return $user->id === $brief->user_id;
    }

    public function download(User $user, Brief $brief)
    {
        return $user->id === $brief->user_id;
    }
}
