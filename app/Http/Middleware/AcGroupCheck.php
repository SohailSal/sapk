<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AccountGroup;

class AcGroupCheck
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
        if(AccountGroup::where('company_id',session('company_id'))->first()){
            return $next($request);
        } 
        else {
            return redirect('group')->with('message','Create Account Group First!');
        }
    }
}
