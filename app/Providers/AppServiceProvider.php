<?php

namespace App\Providers;

use App\Models\Room;
use App\Models\User;
use App\Models\Student;
use App\Observers\UserObserver;
use App\Interfaces\RoomInterface;
use App\Interfaces\StudentInterface;
use App\Repositories\RoomRepository;
use App\Repositories\StudentRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(StudentInterface::class, StudentRepository::class);
        $this->app->bind(RoomInterface::class, RoomRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
    }
}
