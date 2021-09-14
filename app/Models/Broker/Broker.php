<?php

namespace App\Models\Broker;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Broker extends Model
{
    use HasFactory;//, SoftDeletes;

    protected $table = 'liq_saas_user';

    protected $fillable = ['name','active'];

    public function carriers() {
        return $this->belongsToMany(\App\Models\Carrier::class, 'liq_master_file_carriers', 'saas_user_id', 'carrierProfileId')->withPivot('kosher','kosherExpiration','email','autoInsuranceExpiration',
            'autoInsuranceLimit','cargoInsuranceExpiration','cargoInsuranceLimit','generalLiabilityInsuranceExpiration',
            'generalLiabilityInsuranceLimit','workCompInsuranceExpiration','workCompInsuranceLimit','note','riskAlerts','contractOnFile',
            'w9OnFile','insuranceOnFile','goodStanding','carrierServiceRating','carrierSafetyRating','accountingId','sentToSyncarto'
        );
    }

    /*public function customer() {
        return $this->hasOne(Customer::class, );
    }*/
}