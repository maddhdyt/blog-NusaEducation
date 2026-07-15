<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\Menu;
use Database\Seeders\SidebarSettingSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        
        // Create permissions
        $permissionNames = [
            'manage menus',
            'manage pages',
            'manage categories',
            'manage posts',
        ];
        
        $permissions = [];
        foreach ($permissionNames as $permissionName) {
            $permissions[] = Permission::create(['name' => $permissionName]);
        }
        
        // Assign all permissions to admin role
        $adminRole->givePermissionTo($permissions);
        
        // Create admin user
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@arkaseo.com',
            'password' => Hash::make('password'),
        ]);
        
        $admin->assignRole('admin');
        
        // Create sample categories
        $tech = Category::create([
            'name' => 'Technology',
            'slug' => 'technology',
            'description' => 'Articles about technology and software development',
        ]);
        
        $seo = Category::create([
            'name' => 'SEO',
            'slug' => 'seo',
            'description' => 'Search Engine Optimization tips and tricks',
        ]);
        
        $marketing = Category::create([
            'name' => 'Digital Marketing',
            'slug' => 'digital-marketing',
            'description' => 'Digital marketing strategies and insights',
        ]);
        
        // Create sample pages
        $aboutPage = Page::create([
            'title' => 'About Us',
            'slug' => 'about',
            'content' => '<h1>About ArkaSEO</h1><p>We are a leading SEO and digital marketing agency.</p>',
            'meta_description' => 'Learn more about ArkaSEO',
            'status' => 'published',
        ]);
        
        $contactPage = Page::create([
            'title' => 'Contact',
            'slug' => 'contact',
            'content' => '<h1>Contact Us</h1><p>Get in touch with our team.</p>',
            'meta_description' => 'Contact ArkaSEO',
            'status' => 'published',
        ]);
        
        $servicesPage = Page::create([
            'title' => 'Services',
            'slug' => 'services',
            'content' => '<h1>Our Services</h1><p>SEO, Content Marketing, PPC, and more.</p>',
            'meta_description' => 'ArkaSEO Services',
            'status' => 'published',
        ]);
        
        // Create sample posts
        Post::create([
            'user_id' => $admin->id,
            'category_id' => $seo->id,
            'title' => 'Complete Guide to SEO in 2026',
            'slug' => 'complete-guide-to-seo-2026',
            'excerpt' => 'Learn the latest SEO techniques and best practices for 2026.',
            'content' => '<h2>Introduction to SEO</h2><p>Search Engine Optimization is crucial for online success...</p>',
            'meta_description' => 'Complete guide to SEO best practices in 2026',
            'status' => 'published',
            'published_at' => now(),
        ]);
        
        Post::create([
            'user_id' => $admin->id,
            'category_id' => $tech->id,
            'title' => 'Building Modern Web Applications with Laravel',
            'slug' => 'building-modern-web-apps-laravel',
            'excerpt' => 'Discover how to build scalable web applications using Laravel framework.',
            'content' => '<h2>Why Laravel?</h2><p>Laravel is a powerful PHP framework that makes development easy...</p>',
            'meta_description' => 'Build modern web applications with Laravel',
            'status' => 'published',
            'published_at' => now()->subDay(),
        ]);
        
        Post::create([
            'user_id' => $admin->id,
            'category_id' => $marketing->id,
            'title' => 'Social Media Marketing Strategies for 2026',
            'slug' => 'social-media-marketing-strategies-2026',
            'excerpt' => 'Effective social media marketing strategies to grow your business.',
            'content' => '<h2>Social Media Trends</h2><p>Social media continues to evolve...</p>',
            'meta_description' => 'Social media marketing strategies',
            'status' => 'published',
            'published_at' => now()->subDays(2),
        ]);
        
        Post::create([
            'user_id' => $admin->id,
            'category_id' => $seo->id,
            'title' => 'Draft: Advanced Keyword Research',
            'slug' => 'advanced-keyword-research',
            'excerpt' => 'This is a draft post about keyword research.',
            'content' => '<h2>Keyword Research</h2><p>Coming soon...</p>',
            'meta_description' => 'Keyword research guide',
            'status' => 'draft',
            'published_at' => null,
        ]);
        
        // Create menu structure
        $homeMenu = Menu::create([
            'title' => 'Home',
            'slug' => 'home',
            'url_type' => 'custom',
            'custom_url' => '/',
            'order' => 1,
            'is_active' => true,
        ]);
        
        $aboutMenu = Menu::create([
            'title' => 'About',
            'slug' => 'about',
            'url_type' => 'page',
            'page_id' => $aboutPage->id,
            'order' => 2,
            'is_active' => true,
        ]);
        
        $servicesMenu = Menu::create([
            'title' => 'Services',
            'slug' => 'services',
            'url_type' => 'page',
            'page_id' => $servicesPage->id,
            'order' => 3,
            'is_active' => true,
        ]);
        
        $blogMenu = Menu::create([
            'title' => 'Blog',
            'slug' => 'blog',
            'url_type' => 'post',
            'order' => 4,
            'is_active' => true,
        ]);
        
        // Blog submenu (categories)
        Menu::create([
            'parent_id' => $blogMenu->id,
            'title' => 'SEO',
            'slug' => 'blog-seo',
            'url_type' => 'category',
            'category_id' => $seo->id,
            'order' => 1,
            'is_active' => true,
        ]);
        
        Menu::create([
            'parent_id' => $blogMenu->id,
            'title' => 'Technology',
            'slug' => 'blog-technology',
            'url_type' => 'category',
            'category_id' => $tech->id,
            'order' => 2,
            'is_active' => true,
        ]);
        
        Menu::create([
            'parent_id' => $blogMenu->id,
            'title' => 'Marketing',
            'slug' => 'blog-marketing',
            'url_type' => 'category',
            'category_id' => $marketing->id,
            'order' => 3,
            'is_active' => true,
        ]);
        
        $contactMenu = Menu::create([
            'title' => 'Contact',
            'slug' => 'contact',
            'url_type' => 'page',
            'page_id' => $contactPage->id,
            'order' => 5,
            'is_active' => true,
        ]);

        $this->call([
            SidebarSettingSeeder::class,
        ]);
    }
}
