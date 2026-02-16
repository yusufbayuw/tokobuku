<?php

namespace App\Http\Controllers;

use App\Services\License\LicenseService;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    protected $licenseService;

    public function __construct(LicenseService $licenseService)
    {
        $this->licenseService = $licenseService;
    }

    public function show()
    {
        // If already licensed, go home
        if ($this->licenseService->checkLicense()) {
            return redirect('/');
        }

        $signature = $this->licenseService->getSystemSignature();

        return view('license.activate', compact('signature'));
    }

    public function activate(Request $request)
    {
        $request->validate([
            'license_key' => 'required|string',
        ]);

        if ($this->licenseService->activate($request->license_key)) {
            return redirect('/')->with('success', 'License activated successfully!');
        }

        return back()->with('error', 'Invalid license key for this machine.');
    }

    public function status()
    {
        $details = $this->licenseService->getLicenseDetails();
        $isValid = $this->licenseService->checkLicense();

        // Even if valid, calculate signature
        $systemSignature = $this->licenseService->getSystemSignature();

        return view('license.status', compact('details', 'isValid', 'systemSignature'));
    }
}
