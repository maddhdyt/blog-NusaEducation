<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\Menu;
use App\Models\SidebarSetting;
use App\Models\Category;
use App\Models\Post;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['frontend.partials.navbar', 'frontend.partials.footer'], function ($view) {
            $sidebarSetting = Cache::rememberForever('sidebar_setting', function () {
                return SidebarSetting::first();
            });
            $view->with('sidebarSetting', $sidebarSetting);
        });

        View::composer('frontend.partials.navbar', function ($view) {
            $menus = Cache::rememberForever('navbar_menus', function () {
                return Menu::active()->parentOnly()->with('children')->orderBy('order')->get();
            });
            
            $sidebarSetting = $view->getData()['sidebarSetting'] ?? SidebarSetting::first();
            $siteLogo = optional($sidebarSetting)->site_logo_url ?: 'https://ik.imagekit.io/yqhp1cmbp/logo%20nusa%20education.png?tr=w-640,q-75,f-auto';
            
            $view->with('menus', $menus)->with('siteLogo', $siteLogo);
        });

        View::composer('frontend.partials.footer', function ($view) {
            $footerMenus = Cache::rememberForever('footer_menus', function () {
                return Menu::active()->parentOnly()->with('children')->orderBy('order')->get();
            });
            
            $footerCategories = Cache::remember('footer_categories', now()->addHours(24), function () {
                return Category::withCount('publishedPosts')
                    ->orderByDesc('published_posts_count')
                    ->limit(5)
                    ->get();
            });
            
            $footerPosts = Cache::remember('footer_posts', now()->addHours(1), function () {
                return Post::published()->with('category')->latest('published_at')->limit(4)->get();
            });
            
            $view->with('footerMenus', $footerMenus)
                 ->with('footerCategories', $footerCategories)
                 ->with('footerPosts', $footerPosts);
        });
    }
}
