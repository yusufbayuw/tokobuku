<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        /* URL::macro(
            'alternateHasCorrectSignature',
            function (Request $request, $absolute = true, array $ignoreQuery = []) {
                $ignoreQuery[] = 'signature';

                $absoluteUrl = url($request->path());
                $url = $absolute ? $absoluteUrl : '/' . $request->path();

                $queryString = collect(explode('&', (string) $request
                    ->server->get('QUERY_STRING')))
                    ->reject(fn($parameter) => in_array(Str::before($parameter, '='), $ignoreQuery))
                    ->join('&');

                $original = rtrim($url . '?' . $queryString, '?');

                // Use the application key as the HMAC key
                $key = config('app.key'); // Ensure app.key is properly set in .env

                if (empty($key)) {
                    throw new \RuntimeException('Application key is not set.');
                }

                $signature = hash_hmac('sha256', $original, $key);
                return hash_equals($signature, (string) $request->query('signature', ''));
            }
        );

        URL::macro('alternateHasValidSignature', function (Request $request, $absolute = true, array $ignoreQuery = []) {
            return URL::alternateHasCorrectSignature($request, $absolute, $ignoreQuery)
                && URL::signatureHasNotExpired($request);
        });

        Request::macro('hasValidSignature', function ($absolute = true, array $ignoreQuery = []) {
            return URL::alternateHasValidSignature($this, $absolute, $ignoreQuery);
        }); */
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();

        if (env('APP_ENV') === "production") {
            URL::forceScheme('https');
        }

        // Integrity Check: Verify Core File hasn't been tampered with
        /* 
         * This hash corresponds to the original LicenseService.php.
         * If someone modifies the file (e.g. changes 'return false' to 'return true'),
         * this hash will change and the app will crash.
         */
        $path = app_path('Services/License/LicenseService.php');
        if (file_exists($path)) {
            $hash = md5_file($path);
            // Replace this with the hash from `md5 app/Services/License/LicenseService.php` if you modify the file legitly.
            if ($hash !== '45df9fa107e6dbe884850dcf108ac1e2') {
                abort(500, 'System Integrity Violation: Core file modified illegally.');
            }
        }
    }
}
