<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyChange
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if ($message2 = $request->company){
            DB::transaction(function () use ($message2) {
                $cos = auth()->user()->companies;
                foreach($cos as $co){
                    foreach($co->settings as $setting){
                        if(($setting->key =='active')&&($setting->value == 'yes')&&($setting->user_id == auth()->user()->id))
                        $setting->update(['value' => '']);
                    }
                }
                $newset = \App\Models\Setting::where('company_id',$message2)->where('user_id', auth()->user()->id)->where('key','active')->first();
                $newset->update(['value' => 'yes']);
                session(['company_id' => $message2 ]);
            });          
        }
        else{
                $cos = auth()->user()->companies;
                foreach($cos as $co){
                    foreach($co->settings as $setting){
                        if(($setting->key =='active')&&($setting->value == 'yes')&&($setting->user_id == auth()->user()->id))
                        session(['company_id' => $setting->company_id ]);
                }
            }
        }

        if ($request->email && $request->comp){
            DB::transaction(function () use ($request) {
                $role = $request->role;
                $company = \App\Models\Company::where('id',$request->comp)->first();
                $user = \App\Models\User::where('email',$request->email)->first();
                if($setting = \App\Models\Setting::where('company_id',$company->id)->where('user_id',$user->id)->where('key','role')->first()){
                    $setting->update(['value' => $role]);
                } else {
                    $company->users()->attach($user->id);
                    if(count($user->companies) == 1){
                        \App\Models\Setting::create(['company_id' => $request->comp, 'key' => 'active' , 'value' => 'yes', 'user_id' => $user->id]);
                    }else{
                        \App\Models\Setting::create(['company_id' => $request->comp, 'key' => 'active' , 'value' => '', 'user_id' => $user->id]);
                    }
                    \App\Models\Setting::create(['company_id' => $request->comp, 'key' => 'role' , 'value' => $request->role, 'user_id' => $user->id]);
                }
            });
        }

        return $next($request);
    }
}
