<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'designation',
        'photo',
    ];

    public function Designation()
    {
        return $this->belongsTo(Designation::class);
    }
}
