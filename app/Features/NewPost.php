<?php

namespace App\Features;

use App\Models\User;
use Illuminate\Support\Lottery;
use Laravel\Pennant\Attributes\Name;
use function config;


class NewPost
{
    /**
     * Resolve the feature's initial value.
     */
    public function resolve(User $user): mixed
    {
        return ($user->id % 100) < config('pennant.new-post-percent');
    }
}
