<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portfolio extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'portfolios';

    protected $guarded = ['created_at', 'updated_at'];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
