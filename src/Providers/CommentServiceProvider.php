<?php

namespace amanuel\Comment\Providers;

use amanuel\Comment\Models\Comment;
use amanuel\Comment\Policies\CommentPolicy;
use amanuel\RolePermissions\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Comments');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');
        Route::middleware(['web', 'auth'])
            ->group(__DIR__ . '/../Routes/comments_routes.php');

        Gate::policy(Comment::class, CommentPolicy::class);
    }

    public function boot()
    {
        $this->app->booted(function () {
            config()->set('sidebar.items.comments', [
                "icon" => "i-comments",
                "title" => "Comments",
                "url" => route('comments.index'),
                "permission" => [Permission::PERMISSION_MANAGE_COMMENTS,Permission::PERMISSION_TEACH]
            ]);
        });
        view()->composer('Dashboard::layout.header', function ($view){
            $notifications = auth()->user()->unreadNotifications;
            return $view->with(compact('notifications'));
        });
    }
}
