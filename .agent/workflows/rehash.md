---
description: Recalculate file integrity hashes after any code change
---

# System Rehash Workflow

Run this command after making any code changes to files that are protected by the integrity system.

## When to Run

Run `system:rehash` after editing any of these files:
1. `app/Support/SystemBoot.php`
2. `app/Models/User.php`
3. `app/Providers/AppServiceProvider.php`
4. `app/Http/Middleware/VerifyConfigIntegrity.php`
5. `app/Observers/G003M012SaleItemObserver.php`
6. `app/Models/G001M004Book.php`
7. `app/Filament/Pages/Laporan.php`
8. `app/Providers/Filament/AdminPanelProvider.php`

## Command

// turbo
1. Run the rehash command:
```bash
php artisan system:rehash
```

The command will recalculate SHA256 hashes for all 8 protected files and update `bootstrap/cache/config_validation.php`.
