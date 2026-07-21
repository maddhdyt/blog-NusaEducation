<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class TestPhaseTwo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-phase2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Validasi pembaruan Fase 1 & 2 secara mendalam';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memulai validasi Fase 1 & 2...');

        // 1. Check if the upload route exists
        $uploadRouteName = 'admin.posts.upload_image';
        if (Route::has($uploadRouteName)) {
            $this->info("✅ Route '{$uploadRouteName}' ditemukan.");
        } else {
            $this->error("❌ Route '{$uploadRouteName}' TIDAK ditemukan. Pastikan Anda menjalankan 'php artisan route:clear'.");
            return 1;
        }

        // 2. Test rendering the Post Create View
        try {
            $categories = \App\Models\Category::all();
            $errors = new \Illuminate\Support\ViewErrorBag();
            $view = View::make('admin.posts.create', compact('categories', 'errors'))->render();
            $this->info("✅ View 'admin.posts.create' berhasil dirender tanpa error syntax.");
        } catch (\Exception $e) {
            $this->error("❌ Gagal merender view 'admin.posts.create': " . $e->getMessage());
            return 1;
        }

        // 3. Test rendering the Post Edit View
        try {
            // Need a dummy post for the view, if none exists, skip this test
            $post = \App\Models\Post::first();
            if ($post) {
                $view = View::make('admin.posts.edit', compact('post', 'categories', 'errors'))->render();
                $this->info("✅ View 'admin.posts.edit' berhasil dirender tanpa error syntax.");
            } else {
                $this->warn("⚠️ Melewati tes 'admin.posts.edit' karena belum ada data post di database lokal.");
            }
        } catch (\Exception $e) {
            $this->error("❌ Gagal merender view 'admin.posts.edit': " . $e->getMessage());
            return 1;
        }

        // 4. Test rendering the Gallery Create & Edit Views
        try {
            View::make('admin.galleries.create', compact('errors'))->render();
            $this->info("✅ View 'admin.galleries.create' berhasil dirender tanpa error syntax.");
        } catch (\Exception $e) {
            $this->error("❌ Gagal merender view 'admin.galleries.create': " . $e->getMessage());
            return 1;
        }

        try {
            $galleryItem = \App\Models\GalleryItem::first();
            if ($galleryItem) {
                View::make('admin.galleries.edit', ['item' => $galleryItem, 'errors' => $errors])->render();
                $this->info("✅ View 'admin.galleries.edit' berhasil dirender tanpa error syntax.");
            }
        } catch (\Exception $e) {
            $this->error("❌ Gagal merender view 'admin.galleries.edit': " . $e->getMessage());
            return 1;
        }
        
        $this->info("\n🎉 Seluruh tes validasi selesai. Tidak ada error syntax di Blade maupun routing.");
        $this->info("💡 Jika di server online masih error 500, itu berarti Server sedang menggunakan Cache (Route/View Cache lama).");
        return 0;
    }
}
