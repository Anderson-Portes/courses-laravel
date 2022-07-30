<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = ['state', 'city', 'district', 'complement', 'number', 'cep'];
    protected $table = 'address';

    public function student()
    {
        return $this->hasOne(Student::class);
    }
}
