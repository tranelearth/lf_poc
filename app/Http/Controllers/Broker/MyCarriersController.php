<?php
declare(strict_types = 1);

namespace App\Http\Controllers\Broker;
  
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Inertia;
use App\Models\Broker\Broker;
use App\Models\Carrier;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Laravel\Jetstream\Jetstream;
  
class MyCarriersController extends \App\Http\Controllers\Controller
{
    public function index(): \Inertia\Response
    {
        $broker = Broker::find(1);
        $broker->load('carriers');
//var_dump($broker); die;
        return Inertia::render('Broker/MyCarriers/Index', [
            'filters' => Request::all('search', 'trashed'),
            'broker' => $broker,
            'error' => null,
        ]);
    }
  
    public function create(Broker $broker): \Inertia\Response
    {
        $team = Auth::user()->currentTeam;
        if(!Auth::user()->hasTeamPermission($team, 'myCarriers.createOthers')){
            abort(401);
        }

        return Inertia::render('MyCarriers/Create', ['broker' => $broker]);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $requestData = $request->all();

        $team = Auth::user()->currentTeam;
        if(!Auth::user()->hasTeamPermission($team, 'myCarriers.createOthers')){
            abort(401);
        }

        //If carrier update looks valid, proceed
        Validator::make($requestData, $this->getValidationArray())->validate();
        $broker = Broker::find($requestData['broker_id']);
        $broker->carriers()->attach($requestData['carrier_id'], ['notes' => $requestData['notes']]);

        $redirect = session('prevUrl') ? Redirect::to(session('prevUrl')) : Redirect::route('MyCarriers.index');
        return $redirect->with('message', 'Carrier Added Successfully.');
    }

/*    public function edit(Carrier $carrier, Broker $broker): \Inertia\Response
    {
        if(!Auth::user()->hasTeamPermission('myCarriers.update')){
            abort(401);
        }
        return Inertia::render('MyCarriers/Edit', [
            'broker' => $broker->carriers->only($broker->id)->first(),
        ]);
    }
    public function update(Carrier $carrier, Request $request): ?\Illuminate\Http\RedirectResponse
    {
        if(!Auth::user()->hasTeamPermission('myCarriers.update')){
            abort(401);
        }
        $requestData = $request->all();
        Validator::make($requestData, $this->getValidationArray())->validate();
        //update notes
        $carrier->brokers()->updateExistingPivot($requestData['saas_user_id'], ['notes' => $requestData['notes']]);
        //redirect
        $redirect = session('prevUrl') ? Redirect::to(session('prevUrl')) : Redirect::route('myCarriers.index');
        return $redirect->with('message', 'Broker Updated Successfully.');
    }
*/  
    public function remove(Carrier $carrier, Broker $broker): ?\Illuminate\Http\RedirectResponse
    {
        $team = Auth::user()->currentTeam;
        if(!Auth::user()->hasTeamPermission($team, 'myCarriers.removeOthers')){
            abort(401);
        }

        $broker->carriers()->detach((int)$carrier->id);
 
        return redirect()->back()->with('message', 'Carrier removed.');
    }

    private function getValidationArray(): Array
    {
        return [
            'broker_id' => ['required', 'integer'],
            'carrier_id' => ['required', 'integer'],
            'notes' => ['nullable'],
        ];
    }
/*
    private function hasCarrierPermission(Carrier $carrier, String $permission) {
        $team = Auth::user()->currentTeam;
        if(
            $carrier
            && (
                Auth::user()->hasTeamPermission($team, $permission)
                || Auth::user()->id === $carrier->user_id
            )
        ) {
            return true;
        }
        return false;
    }*/
}