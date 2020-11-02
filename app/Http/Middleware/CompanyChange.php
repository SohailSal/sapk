<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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

            $cos = auth()->user()->companies;
            foreach($cos as $co){
                foreach($co->settings as $setting){
                    if(($setting->key =='active')&&($setting->value == 'yes'))
                    $setting->update(['value' => '']);
                }
            }
            $newset = \App\Models\Setting::where('company_id',$message2)->where('key','active')->first();
            $newset->update(['value' => 'yes']);
            session(['company_id' => $message2 ]);
        }
        else{
                $cos = auth()->user()->companies;
                foreach($cos as $co){
                    foreach($co->settings as $setting){
                        if(($setting->key =='active')&&($setting->value == 'yes'))
                        session(['company_id' => $setting->company_id ]);
                }
            }

        }

        return $next($request);
    }
}
