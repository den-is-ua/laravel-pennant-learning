<?php

namespace App\Models;

use App\Policies\PostPolicy;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

#[Fillable(['title', 'body'])]
class Post extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
