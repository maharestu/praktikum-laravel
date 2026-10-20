<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    // =========================================================================
    // A. Otorisasi & Authentication
    // =========================================================================

    public function test_guest_cannot_access_categories_index(): void
    {
        $response = $this->get(route('categories.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_kasir_cannot_access_categories_index(): void
    {
        $kasir = User::factory()->create(); // default role = kasir

        $response = $this->actingAs($kasir)->get(route('categories.index'));

        $response->assertStatus(403);
    }

    public function test_admin_can_access_categories_index(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->get(route('categories.index'));

        $response->assertStatus(200);
    }

    // =========================================================================
    // B. Index (Menampilkan Daftar Kategori)
    // =========================================================================

    public function test_index_displays_categories(): void
    {
        $admin = User::factory()->admin()->create();
        $category = Category::factory()->create(['name' => 'Elektronik']);

        $response = $this->actingAs($admin)->get(route('categories.index'));

        $response->assertStatus(200);
        $response->assertSee('Elektronik');
    }

    public function test_index_shows_empty_state_when_no_categories(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->get(route('categories.index'));

        $response->assertStatus(200);
        $response->assertSee('Belum ada data kategori.');
    }

    // =========================================================================
    // C. Create (Menampilkan Form)
    // =========================================================================

    public function test_admin_can_view_create_category_form(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->get(route('categories.create'));

        $response->assertStatus(200);
        $response->assertSee('Tambah Kategori');
    }

    // =========================================================================
    // D. Store (Menyimpan Kategori Baru)
    // =========================================================================

    public function test_admin_can_store_category(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->post(route('categories.store'), [
            'name' => 'Makanan',
            'description' => 'Kategori untuk makanan',
        ]);

        $response->assertRedirect(route('categories.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('categories', [
            'name' => 'Makanan',
            'description' => 'Kategori untuk makanan',
        ]);
    }

    public function test_store_category_without_name_fails_validation(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->post(route('categories.store'), [
            'name' => '',
            'description' => 'Deskripsi tanpa nama',
        ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_store_category_with_duplicate_name_fails(): void
    {
        $admin = User::factory()->admin()->create();
        Category::factory()->create(['name' => 'Elektronik']);

        $response = $this->actingAs($admin)->post(route('categories.store'), [
            'name' => 'Elektronik',
            'description' => 'Duplikat',
        ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_store_category_name_max_100_chars(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->post(route('categories.store'), [
            'name' => str_repeat('A', 101),
            'description' => 'Nama terlalu panjang',
        ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_store_category_description_is_optional(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->post(route('categories.store'), [
            'name' => 'Minuman',
        ]);

        $response->assertRedirect(route('categories.index'));
        $this->assertDatabaseHas('categories', [
            'name' => 'Minuman',
            'description' => null,
        ]);
    }

    // =========================================================================
    // E. Edit & Update
    // =========================================================================

    public function test_admin_can_view_edit_category_form(): void
    {
        $admin = User::factory()->admin()->create();
        $category = Category::factory()->create(['name' => 'Elektronik']);

        $response = $this->actingAs($admin)->get(route('categories.edit', $category));

        $response->assertStatus(200);
        $response->assertSee('Edit Kategori');
        $response->assertSee('Elektronik');
    }

    public function test_admin_can_update_category(): void
    {
        $admin = User::factory()->admin()->create();
        $category = Category::factory()->create(['name' => 'Elektronik']);

        $response = $this->actingAs($admin)->put(route('categories.update', $category), [
            'name' => 'Elektronik Updated',
            'description' => 'Deskripsi baru',
        ]);

        $response->assertRedirect(route('categories.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Elektronik Updated',
            'description' => 'Deskripsi baru',
        ]);
    }

    public function test_update_category_with_invalid_data_fails(): void
    {
        $admin = User::factory()->admin()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($admin)->put(route('categories.update', $category), [
            'name' => '',
        ]);

        $response->assertSessionHasErrors('name');
    }

    // =========================================================================
    // F. Destroy (Menghapus Kategori)
    // =========================================================================

    public function test_admin_can_delete_category(): void
    {
        $admin = User::factory()->admin()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($admin)->delete(route('categories.destroy', $category));

        $response->assertRedirect(route('categories.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }

    public function test_kasir_cannot_delete_category(): void
    {
        $kasir = User::factory()->create(); // default role = kasir
        $category = Category::factory()->create();

        $response = $this->actingAs($kasir)->delete(route('categories.destroy', $category));

        $response->assertStatus(403);
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
        ]);
    }
}
