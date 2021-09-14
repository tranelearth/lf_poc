<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carrier extends Model
{
    use HasFactory;//, SoftDeletes;

    protected $table = 'liq_master_file_carrierprofile';

    protected $fillable = ['saas_user_id','masterUserId','carrierCode','carrierName','dateCreated','yearsInBusiness','scacCode','dotNumber',
        'mcNumber','canadianAuthority','canadianCarrierNumber','mexicanAuthority','numberOfTrucks','numberOfTanks','tanksWithPumps',
        'tanksWithHeat','tanksWithDairyValves','tanksWithFoodGradeValves','regions','streetAddress1','streetAddress2','city','state','zip',
        'latitude','longitude','phone','fax','sentToSyncarto'
    ];

    /*public function positions() {
        return $this->belongsToMany(Position::class);
    }*/

    public function brokers() {
        return $this->belongsToMany(Broker\Broker::class, 'liq_master_file_carriers', 'carrierProfileId', 'saas_user_id')->withPivot('kosher','kosherExpiration','email','autoInsuranceExpiration',
            'autoInsuranceLimit','cargoInsuranceExpiration','cargoInsuranceLimit','generalLiabilityInsuranceExpiration',
            'generalLiabilityInsuranceLimit','workCompInsuranceExpiration','workCompInsuranceLimit','note','riskAlerts','contractOnFile',
            'w9OnFile','insuranceOnFile','goodStanding','carrierServiceRating','carrierSafetyRating','accountingId','sentToSyncarto'
        );
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
