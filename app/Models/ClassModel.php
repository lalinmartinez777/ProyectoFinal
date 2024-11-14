<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes';

    public function admins()
    {
        return $this->belongsTo(Admin::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_class');
    }
}
