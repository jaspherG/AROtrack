<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequirementDocument extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'requirement_id',
        'student_id',
        'service_id',
        'document_id',
        'image',
        'status',
    ];

    public function requirement()
    {
        return $this->belongsTo(Requirement::class, 'requirement_id');
    }

    public function user_student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }
}
