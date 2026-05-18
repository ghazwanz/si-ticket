<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRole;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, HasUuids, Notifiable, SoftDeletes;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the primary key.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
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
            'role' => UserRole::class,
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the organizer profile associated with the user.
     */
    public function organizerProfile()
    {
        return $this->hasOne(OrganizerProfile::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'organizer_id');
    }

    /**
     * Check if the organizer has any events currently published.
     */
    public function hasPublishedEvents(): bool
    {
        return $this->events()->where('status', 'published')->exists();
    }

    /**
     * Check if the organizer has completed events that are awaiting payout settlement.
     */
    public function hasPendingPayouts(): bool
    {
        return $this->events()->where('status', 'completed')
            ->where(function ($query) {
                $query->whereDoesntHave('payout')
                    ->orWhereHas('payout', function ($q) {
                        $q->where('status', '!=', 'completed');
                    });
            })->exists();
    }

    /**
     * Check if the organizer has active paid orders that need fulfillment or settlement.
     */
    public function hasActivePaidOrders(): bool
    {
        if ($this->role !== UserRole::Organizer) {
            return false;
        }

        return Order::whereHas('event', function ($query) {
            $query->where('organizer_id', $this->id)
                ->whereIn('status', ['published', 'pending']);
        })->whereNotNull('paid_at')->exists();
    }
}
