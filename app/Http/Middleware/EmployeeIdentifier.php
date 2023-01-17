<?php

namespace App\Http\Middleware;

use App\Http\Middleware\Traits\HasIdentifierToken;
use Closure;
use Illuminate\Http\Request;

class EmployeeIdentifier
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
        if (!$this->employeeIsValid($decrypt)) {
            errUnauthenticated();
        }

        $request->employee = $decrypt;
        $request->companyOffice = $decrypt['companyOffice'];
        return $next($request);
    }


    /** --- FUNCTIONS --- */

    private function employeeIsValid($employee): bool
    {
        return (isset($employee['id']) && $employee['id']) &&
            (isset($employee['fullName']) && $employee['fullName']) &&
            (isset($employee['employeeNo']) && $employee['employeeNo']) &&
            (isset($employee['user']['id']) && $employee['user']['id']) &&
            (isset($employee['user']['email']) && $employee['user']['email']) &&
            (isset($employee['companyOffice']['id']) && $employee['companyOffice']['id']) &&
            (isset($employee['companyOffice']['name']) && $employee['companyOffice']['name']);
    }

}
