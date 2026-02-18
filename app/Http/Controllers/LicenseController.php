<?php

namespace App\Http\Controllers;

use App\Support\SystemBoot;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    protected $svc;

    public function __construct(SystemBoot $svc)
    {
        $this->svc = $svc;
    }

    public function show()
    {
        if ($this->svc->v()) {
            return redirect('/');
        }

        $signature = $this->svc->sig();

        return view('license.activate', compact('signature'));
    }

    public function activate(Request $request)
    {
        $request->validate([
            'license_key' => 'required|string',
        ]);

        if ($this->svc->store($request->license_key)) {
            return redirect('/')->with('success', 'License activated successfully!');
        }

        return back()->with('error', 'Invalid license key for this machine.');
    }

    public function status()
    {
        $details = $this->svc->meta();
        $isValid = $this->svc->v();
        $systemSignature = $this->svc->sig();

        return view('license.status', compact('details', 'isValid', 'systemSignature'));
    }
}
