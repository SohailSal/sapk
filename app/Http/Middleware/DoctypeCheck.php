<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\DocumentType;

class DoctypeCheck
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
      if(DocumentType::where('company_id',session('company_id'))->first()){
        return $next($request);
      } 
      else {
          return redirect('doctype')->with('message','Create Voucher Type First!');
      }
    }
}
