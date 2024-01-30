<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;


    protected $table = 'portfolios';

    protected $guarded = ['created_at', 'updated_at'];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
