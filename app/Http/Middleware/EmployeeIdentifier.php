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
        $identifier = $request->header('IDENTIFIER');
        if (!$identifier) {
            errUnauthenticated('IDENTIFIER not found');
        }

        $decryptEmployee = $this->decrypt($identifier);
        if (!$this->employeeIsValid($decryptEmployee)) {
            errUnauthenticated("Data employee invalid");
        }

        $access = $request->header('ACCESS');
        if (!$access) {
            errUnauthenticated('ACCESS not found');
        }

        $decryptAccess = $this->decrypt($access) ?: [];

        $request->employee = $decryptEmployee;
        $request->companyOffice = $decryptEmployee['companyOffice'];
        $request->companyOfficeIds = isset($decryptEmployee['companyOfficeIds']) ? $decryptEmployee['companyOfficeIds'] : [$request->companyOffice['id']];
        $request->roles = isset($decryptAccess['roles']) ? $decryptAccess['roles'] : [];
        $request->permissions = isset($decryptAccess['permissions']) ? $decryptAccess['permissions'] : [];

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
