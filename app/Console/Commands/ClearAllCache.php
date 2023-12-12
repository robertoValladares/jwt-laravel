<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearAllCache extends Command
{
    protected $signature = 'cache:clear-all';
    protected $description = 'Clear all caches in the application';

    public function handle()
    {
        // Limpiar caché de configuración, rutas, vistas y más...
        $this->call('config:clear');
        $this->call('route:clear');
        // $this->call('view:clear');
        $this->call('cache:clear');

        $this->info('All caches cleared successfully.');

        // Auto dump al finalizar
        // $this->dump();
    }
}
