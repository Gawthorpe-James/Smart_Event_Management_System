<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class PermsInitCommand extends Command
{
    protected $signature = 'perms:init';

    protected $description = 'Command description';

    public function handle(): void
    {
        //define the roles
        Role::create(['name' => 'administrator']);
        Role::create(['name' => 'organizer']);
        Role::create(['name' => 'attendee']);
    }
}
