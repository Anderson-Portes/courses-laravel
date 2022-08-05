<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "description",
        "price",
        "start_date",
        "end_date",
        "subscribers_quantity",
        "current_subscribers",
        "file_name"
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_student');
    }
}
