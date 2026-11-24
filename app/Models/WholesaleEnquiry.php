<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WholesaleEnquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'contact_person',
        'phone',
        'email',
        'business_type',
        'estimated_quantity',
        'delivery_location',
        'message',
        'status',
        'admin_notes',
    ];

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'new' => 'bg-amber-100 text-amber-800 border-amber-300',
            'contacted' => 'bg-blue-100 text-blue-800 border-blue-300',
            'negotiating' => 'bg-purple-100 text-purple-800 border-purple-300',
            'approved' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
            'closed' => 'bg-zinc-100 text-zinc-800 border-zinc-300',
            default => 'bg-zinc-100 text-zinc-800 border-zinc-300',
        };
    }
}
