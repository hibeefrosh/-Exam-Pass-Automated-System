<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationRequirement extends Model
{
    use HasFactory;
    protected $fillable = [
        'level',
        'document_type',
    ];
}
