<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class userCreateAdministratorCommand extends Command
{
    protected $signature = 'user:create-administrator';

    protected $description = 'Create an administrator user';

    public function handle(): void
    {
        //prompt for details
        $username = $this->ask('Enter the username');
        while (User::where('username', $username)->exists()) {
            $this->error('Username already exists');
            $username = $this->ask('Enter the username');
        }
        $first_name = $this->ask('Enter the first name');
        $last_name = $this->ask('Enter the last name');
        $email = $this->ask('Enter the email address');
        while (User::where('email', $email)->exists()) {
            $this->error('Email address already exists');
            $email = $this->ask('Enter the email address');
        }
        $password = $this->secret('Enter the password');
        //confirm password
        $password_confirmation = $this->secret('Confirm the password');
        while ($password !== $password_confirmation) {
            $this->error('Passwords do not match');
            $password = $this->secret('Enter the password');
            $password_confirmation = $this->secret('Confirm the password');
        }
        //confirm details
        $this->info('Username: '.$username);
        $this->info('First name: '.$first_name);
        $this->info('Last name: '.$last_name);
        $this->info('Email: '.$email);
        if (!$this->confirm('Are these details correct?')) {
            //restart the process
            $this->handle();
        }

        //create the user
        $user = User::create(
            [
                'username' => $username,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'password' => bcrypt($password)
            ]
        );
        $user->assignRole('administrator');
        if ($user) {
            $this->info('User created successfully');
        } else {
            $this->error('Failed to create user');
        }
    }
}
