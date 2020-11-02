<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CompanyActive
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
        $cos = auth()->user()->companies;
        foreach($cos as $co){
            foreach($co->settings as $setting){
                if(($setting->key =='active')&&($setting->value == 'yes'))
                session(['company_id' => $setting->company_id ]);
            }
        }
//        $co = \App\Models\Setting::where('key','active')->where('value','yes')->first();
//        session(['company_id' => $co->company_id ]);
        return $next($request);
    }
}
