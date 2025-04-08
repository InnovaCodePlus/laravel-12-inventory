<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sale extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'client_id',
        'total',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, "sale_details")
            ->withPivot(["quantity", "sub_total", "product_name", "product_price"]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
