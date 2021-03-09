<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Crop extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'image_file',
        'percentage',
        'day_number',
        'batch_id',
        'date_uploaded',
        'status',
    ];
}
