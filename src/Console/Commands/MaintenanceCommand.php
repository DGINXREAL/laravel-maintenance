<?php

namespace DGINX\LaravelMaintenance\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class MaintenanceCommand extends Command
{
    protected $signature = 'dginx:maintenance {state : on or off}';

    protected $description = 'Switching Maintenance Mode';

    public function handle(): void
    {
        if($this->argument("state") === "on"){
            touch(base_path().'/.laravel-maintenance');
        } elseif($this->argument("state") === "off"){
            unlink(base_path() . '/.laravel-maintenance');
        } else {
            throw new InvalidArgumentException("You have to set on or off.");
        }
    }
}
