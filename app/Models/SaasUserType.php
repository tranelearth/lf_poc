<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaasUserType extends Model
{
    use HasFactory;//, SoftDeletes;

    protected $table = 'liq_saas_user__saas_types';

    protected $fillable = ['name','description'];

    /*public function positions() {
        return $this->belongsToMany(Position::class);
    }*/

    public function saas_users() {
        return $this->belongsToMany(SaasUserType::class, 'liq_saas_users__saas_types', 'saas_user_type_id', 'saas_user_id');
    }

    /*public function activity_logs() {
        return $this->hasMany(Recruiting\ActivityLog::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereHas('user', function ($query) use ($search) {
                        $query->where('name', 'like', '%'.$search.'%');
                    });                    
            });
        })->when($filters['position'] ?? null, function ($query, $position) {
            $query->orWhereHas('positions', function ($query) use ($position) {
                        $query->whereIn('position_id', [$position]);
                    });
        })->when($filters['graduation_year'] ?? null, function ($query, $year) {
            $query->where('graduation_year', $year);
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }*/
}
