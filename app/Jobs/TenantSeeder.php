<?php

namespace App\Jobs;

use App\Models\RootUser;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Stancl\Tenancy\Contracts\Tenant;

class TenantSeeder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Tenant $tenant;

    /**
     * Create a new job instance.
     */
    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $rootUser = RootUser::find($this->tenant->root_users_id);
        tenancy()->initialize($this->tenant);

        $user = new User();
        $user->name = $rootUser->name;
        $user->email = $rootUser->email;
        $user->password = $rootUser->password;
        $user->avatar = $rootUser->avatar;
        $user->mobile = $rootUser->mobile;
        $user->gender = $rootUser->gender;
        $user->city = $rootUser->city;
        $user->country = $rootUser->country;
        $user->save();
    }
}
