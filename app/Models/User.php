<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Assign a module-specific role to the user
     * 
     * @param string $role
     * @param string|null $module
     * @return self
     */
    public function assignModuleRole(string $role, ?string $module = null): self
    {
        $roleName = $module ? "{$module}-{$role}" : $role;
        $this->assignRole($roleName);
        return $this;
    }

    /**
     * Check if user has a specific module role
     * 
     * @param string $role
     * @param string|null $module
     * @return bool
     */
    public function hasModuleRole(string $role, ?string $module = null): bool
    {
        $roleName = $module ? "{$module}-{$role}" : $role;
        return $this->hasRole($roleName);
    }

    /**
     * Get user's profile completeness
     * 
     * @return float
     */
    public function getProfileCompletenessAttribute(): float
    {
        $totalFields = 5; // name, email, avatar, bio, etc.
        $completedFields = collect([
            $this->name,
            $this->email,
            $this->avatar ?? null,
            // Add more profile fields
        ])->filter()->count();

        return round(($completedFields / $totalFields) * 100, 2);
    }

    /**
     * Scope a query to only include active users
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Determine if the user is a super admin
     * 
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super-admin');
    }
}
