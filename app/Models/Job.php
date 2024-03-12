<?php

namespace App\Models;

use App\Models\User;
use App\Models\Company;
use App\Models\JobType;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job_positions';

    protected $casts = [              
        'created_at' => 'datetime:Y-m-d H:i',    
    ];

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites', 'job_id', 'user_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function recruiter()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
