<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_reference',
        'donor_name',
        'donor_email',
        'donor_phone',
        'amount',
        'currency',
        'payment_method',
        'status',
        'program_id',
        'message',
        'is_anonymous',
        'payment_data',
        'paid_at',
        'token',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'is_anonymous' => 'boolean',
        'payment_data' => 'array',
        'paid_at' => 'datetime',
    ];

    /**
     * Boot the model and automatically generate unique token.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($donation) {
            if (empty($donation->token)) {
                $donation->token = static::generateUniqueToken();
            }
        });
    }

    /**
     * Generate a unique token for the donation.
     */
    protected static function generateUniqueToken(): string
    {
        do {
            $token = Str::random(32);
        } while (static::where('token', $token)->exists());

        return $token;
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function scopeSuccessful($query)
    {
        return $query->where('status', 'successful');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
