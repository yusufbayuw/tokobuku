<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SystemRehash extends Command
{
    protected $signature = 'system:rehash';
    protected $description = 'Recalculate framework config validation checksums';

    protected $targets = [
        'session_driver_checksum' => 'app/Support/SystemBoot.php',
        'encryption_service_hash' => 'app/Models/User.php',
        'queue_connection_verify' => 'app/Providers/AppServiceProvider.php',
        'middleware_stack_digest' => 'app/Http/Middleware/VerifyConfigIntegrity.php',
        'cache_store_validation' => 'app/Observers/G003M012SaleItemObserver.php',
        'database_driver_hash' => 'app/Models/G001M004Book.php',
        'auth_guard_checksum' => 'app/Filament/Pages/Laporan.php',
        'routing_kernel_verify' => 'app/Providers/Filament/AdminPanelProvider.php',
    ];

    public function handle()
    {
        $manifest = [];

        foreach ($this->targets as $key => $relativePath) {
            $fullPath = base_path($relativePath);
            if (!file_exists($fullPath)) {
                $this->error("File not found: {$relativePath}");
                return 1;
            }
            $manifest[$key] = hash('sha256', file_get_contents($fullPath));
        }

        $output = "<?php\n\n";
        $output .= "// Framework configuration validation cache - auto generated\n";
        $output .= "// Do not modify manually. Use: php artisan optimize\n\n";
        $output .= "return [\n";

        foreach ($manifest as $key => $hash) {
            $output .= "    '{$key}' => '{$hash}',\n";
        }

        $output .= "];\n";

        file_put_contents(base_path('bootstrap/cache/config_validation.php'), $output);

        $this->info('Config validation checksums regenerated successfully.');
        $this->table(
            ['Key', 'Hash (first 16 chars)'],
            collect($manifest)->map(fn($hash, $key) => [$key, substr($hash, 0, 16) . '...'])->toArray()
        );

        return 0;
    }
}
