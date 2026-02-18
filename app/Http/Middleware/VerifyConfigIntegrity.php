<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyConfigIntegrity
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('license/*')) {
            return $next($request);
        }

        $b = app(\App\Support\SystemBoot::class);
        if (!$b->v()) {
            return redirect()->route('license.show');
        }

        $this->cv();

        return $next($request);
    }

    protected function cv(): void
    {
        static $checked = false;
        if ($checked)
            return;
        $checked = true;

        $m = base_path(base64_decode('Ym9vdHN0cmFwL2NhY2hlL2NvbmZpZ192YWxpZGF0aW9uLnBocA=='));
        if (!file_exists($m)) {
            abort(500, base64_decode('Q29uZmlndXJhdGlvbiBjYWNoZSBub3QgZm91bmQu'));
        }

        $h = require $m;
        $t = [
            base64_decode('c2Vzc2lvbl9kcml2ZXJfY2hlY2tzdW0=') => base64_decode('YXBwL1N1cHBvcnQvU3lzdGVtQm9vdC5waHA='),
            base64_decode('bWlkZGxld2FyZV9zdGFja19kaWdlc3Q=') => base64_decode('YXBwL0h0dHAvTWlkZGxld2FyZS9WZXJpZnlDb25maWdJbnRlZ3JpdHkucGhw'),
        ];

        foreach ($t as $k => $f) {
            $fp = base_path($f);
            if (!file_exists($fp))
                continue;
            if (!isset($h[$k]) || empty($h[$k]))
                continue;
            if (hash('sha256', file_get_contents($fp)) !== $h[$k]) {
                abort(500, base64_decode('RW5jcnlwdGlvbiBrZXkgbWlzbWF0Y2ggZGV0ZWN0ZWQu'));
            }
        }
    }
}
