<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;


    protected $table = 'events';


    protected $fillable = [
        'nama_event',
        'tanggal_event',
        'lokasi',
        'deskripsi_singkat',
        'harga_min',
        'image_url',
        'kategori',
    ];


    protected $casts = [
        'tanggal_event' => 'date',
    ];
}

