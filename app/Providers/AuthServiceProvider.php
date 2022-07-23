<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Module' => 'App\Policies\ModulePolicy',
        'App\Models\About' => 'App\Policies\AboutUsPolicy',
        'App\Models\Bar' => 'App\Policies\BarPolicy',
        'App\Models\Event' => 'App\Policies\EventPolicy',
        'App\Models\Gallery' => 'App\Policies\GalleryPolicy',
        'App\Models\Room' => 'App\Policies\RoomPolicy',
        'App\Models\Booking' => 'App\Policies\BookingPolicy',
        'App\Models\Permission' => 'App\Policies\PermissionPolicy',
        'App\Models\Recreation' => 'App\Policies\RecreationPolicy',
        'App\Models\Role' => 'App\Policies\RolePolicy',
        'App\Models\RoleModulePermissionMapping' => 'App\Policies\RoleModulePermissionMappingPolicy',
        'App\Models\Service' => 'App\Policies\ServicePolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Room\RoomType' => 'App\Policies\RoomTypePolicy',
        'App\Models\Room\RoomFeature' => 'App\Policies\RoomFeaturePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
