<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrderDetail;
use App\Models\OrderAddress;
use App\Models\OrderCarrier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'statut',
        'reference',
        'stripe_id',
        'somme',
        'address',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function orderAddresses(): HasMany
    {
        return $this->hasMany(OrderAddress::class);
    }

    public function orderAddress()
    {
        return $this->hasOne(OrderAddress::class);
    }

    public function orderCarrier()
    {
        return $this->hasOne(OrderCarrier::class);
    }

    public function cleanOrder()
    {
        // Supprimer les détails de commande associés
        $this->orderDetails()->delete();

        // Supprimer les adresses de commande associées
        $this->orderAddresses()->delete();

        // Supprimer la commande elle-même
        $this->delete();
    }
}
