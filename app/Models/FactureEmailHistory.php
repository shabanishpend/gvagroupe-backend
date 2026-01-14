<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactureEmailHistory extends Model
{
    use HasFactory;

    protected $table = 'facture_email_history';
    
    protected $fillable = [
        'facture_id',
        'user_id',
        'recipient_email',
        'subject',
        'email_content',
        'status',
        'error_message',
        'sent_at',
        'failed_at'
    ];

    protected $casts = [
        'sent_at' => 'datetime',
        'failed_at' => 'datetime',
    ];

    /**
     * Get the facture that this email history record belongs to
     */
    public function facture()
    {
        return $this->belongsTo(Facture::class, 'facture_id');
    }

    /**
     * Get the user who sent the email
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get a formatted status badge
     */
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'bg-warning-subtle text-warning',
            'sent' => 'bg-success-subtle text-success',
            'failed' => 'bg-danger-subtle text-danger'
        ];

        $status = $this->status ?? 'pending';
        $badgeClass = $badges[$status] ?? 'bg-secondary-subtle text-secondary';

        return "<span class='badge {$badgeClass}'>{$this->status}</span>";
    }

    /**
     * Check if email was successful
     */
    public function isSuccessful()
    {
        return $this->status === 'sent';
    }

    /**
     * Check if email failed
     */
    public function isFailed()
    {
        return $this->status === 'failed';
    }

    /**
     * Check if email is pending
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }
}
