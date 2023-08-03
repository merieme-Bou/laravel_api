<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a new user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user['name'] = $this->ask('name of the new user');
        $user['email'] = $this->ask('Email of the new user');

        $user['password'] = $this->secret('Password of the new user');


        $roleName = $this->choice('Role of the new user', ['admin', 'editor']);

        $role = Role::where('name', $roleName)->first();
        if (!$role) {
            $this->error('Role not found');
            return -1;
        }

        DB::transaction(function () use ($user, $role) {

            $user['password']=Hash::make($user['password']);
            $newUser = User::create($user);
            $newUser->roles()->attach($role->id);
        });




        $this->info('User'.$user['email'] .'create successfully');
        return 0;
    }
}
