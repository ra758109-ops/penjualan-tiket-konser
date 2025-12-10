<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;


    protected $table = 'tickets_for_sale';


    protected $fillable = [

        'user_id',
        'event_name',
        'category',
        'zone',
        'price',
        'quantity',
        'proof_path',
        'status',
    

    ];

    public function user()
{
    return $this->belongsTo(User::class);
}
}
