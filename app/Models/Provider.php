<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'providers';

    protected $guarded = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function portfolio()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }
}
