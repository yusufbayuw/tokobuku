<?php

namespace App\Http\Middleware;

use App\Services\License\LicenseService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureLicenseIsValid
{
    protected $licenseService;

    public function __construct(LicenseService $licenseService)
    {
        $this->licenseService = $licenseService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Exclude license routes to prevent infinite loop
        if ($request->is('license/*')) {
            return $next($request);
        }

        if (!$this->licenseService->checkLicense()) {
            return redirect()->route('license.show');
        }

        return $next($request);
    }
}
