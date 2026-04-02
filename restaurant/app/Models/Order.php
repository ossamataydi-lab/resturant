<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_PREPARING = 'preparing';
    const STATUS_READY = 'ready';
    const STATUS_COMPLETED = 'completed';

    // Type constants
    const TYPE_DELIVERY = 'delivery';
    const TYPE_TAKEAWAY = 'takeaway';

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'type',
        'customer_name',
        'customer_phone',
        'address',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Get status color for badges
    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'pending' => 'warning',
            'preparing' => 'info',
            'ready' => 'success',
            'completed' => 'secondary',
            default => 'secondary',
        };
    }

    // Get status label in French
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'pending' => 'En attente',
            'preparing' => 'En préparation',
            'ready' => 'Prêt',
            'completed' => 'Livré',
            default => $this->status,
        };
    }

    // Get type label in French
    public function getTypeLabelAttribute()
    {
        return match ($this->type) {
            'delivery' => 'Livraison',
            'takeaway' => 'À emporter',
            default => $this->type,
        };
    }

    // Calculate total from order items
    public function calculateTotal()
    {
        return $this->orderItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    }
}
