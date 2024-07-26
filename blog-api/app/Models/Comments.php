<?php

namespace App\Models;

use App\Jobs\SendSuperAdminEmailJob;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;
use Spatie\Permission\Models\Role;


class Comments extends Model
{
    use HasFactory;
    protected $fillable = ['post_id', 'name', 'email', 'content', 'is_visible'];

    protected static function boot(){
        parent::boot();

        static::created(function ($comment) {
        // Super Admin rolünü bul
        $superAdminRole = Role::where('name', 'super_admin')->first();

        // Bu role sahip kullanıcıların e-posta adreslerini bul
        $superAdminEmails = User::role($superAdminRole->name)->pluck('email');

        SendSuperAdminEmailJob::dispatch($superAdminEmails);
        });
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

}

