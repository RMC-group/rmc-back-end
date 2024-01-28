<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = "customer";

    protected $primaryKey = 'cust_id';

    protected $fillable = ['user_id'];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
