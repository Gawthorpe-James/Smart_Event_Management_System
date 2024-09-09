<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

return new class extends Migration {
    public function up(): void
    {
        //define the roles
        Role::create(['name' => 'administrator']);
        Role::create(['name' => 'organizer']);
        Role::create(['name' => 'attendee']);
    }

    public function down(): void
    {
        Schema::dropIfExists('');
    }
};
