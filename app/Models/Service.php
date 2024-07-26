<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'service_name',
        'document_ids',
    ];

    public function documents()
    {
        return $this->belongsToMany(Document::class);
    }

    public function requirements()
    {
        return $this->hasMany(Requirement::class);
    }

    public function requirement_documents()
    {
        return $this->hasMany(RequirementDocument::class);
    }
}
