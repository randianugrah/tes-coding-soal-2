<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

     /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'no_hp',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}