<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPostTest extends TestCase
{
    /**
     * Test admin can view post create page
     */
    public function test_admin_can_view_post_create_page(): void
    {
        $admin = User::first(); // Assuming first user is admin, or we can use factory

        $response = $this->actingAs($admin)
                         ->get(route('admin.posts.create'));

        $response->assertStatus(200);
        $response->assertSee('admin.posts.upload_image');
    }
}
