<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'student_id',
        'service_id',
        'class_year',
        'academic_year',
        'course',
        'program_id',
        'status',
        'deleted_flag',
        'previous_school',
        'is_new_student',
        'year_admitted'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if($model->service_id == 1){
                if ($model->class_year === 'First Year') {
                    $model->is_new_student = 0;
                } else {
                    $model->is_new_student = 1;
                }
            }
            
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function user_student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function requirement_documents()
    {
        return $this->hasMany(RequirementDocument::class);
    }

    public function requirement_remarks()
    {
        return $this->hasMany(RequirementRemark::class);
    }
}
