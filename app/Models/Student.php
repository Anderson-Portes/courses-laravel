<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'cpf',
        'telephone',
        'phone',
        'company',
        'address_id',
        'user_id',
        'course_id',
        'category',
        'paid_out'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
