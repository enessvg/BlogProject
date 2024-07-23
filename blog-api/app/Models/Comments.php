<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Comments extends Model
{
    use HasFactory;
    protected $fillable = ['post_id', 'name', 'email', 'content', 'is_visible'];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

}

