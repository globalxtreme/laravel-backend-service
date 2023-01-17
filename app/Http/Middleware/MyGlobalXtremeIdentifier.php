<?php

namespace App\Http\Middleware;

use App\Http\Middleware\Traits\HasIdentifierToken;
use Closure;
use Illuminate\Http\Request;

class MyGlobalXtremeIdentifier
{
    use HasIdentifierToken;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $decrypt = $this->decrypt($request);
        if (!$this->customerIsValid($decrypt)) {
            errUnauthenticated();
        }

        $request->customer = $decrypt;
        $request->companyOffice = $decrypt['companyOffice'];
        return $next($request);
    }


    /** --- FUNCTIONS --- */

    private function customerIsValid($employee): bool
    {
        return (isset($employee['uuid']) && $employee['uuid']) &&
            (isset($employee['accountNumber']) && $employee['accountNumber']) &&
            (isset($employee['holderName']) && $employee['holderName']) &&
            (isset($employee['contactInfo']) && $employee['contactInfo']) &&
            (isset($employee['serviceLocations']) && $employee['serviceLocations']);
    }

}
