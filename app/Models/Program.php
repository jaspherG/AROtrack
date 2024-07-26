<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'program_name',
        'description',
    ];

    public function students()
    {
        return $this->hasMany(User::class);
    }

    public function requirements()
    {
        return $this->hasMany(Requirement::class);
    }
   
}
