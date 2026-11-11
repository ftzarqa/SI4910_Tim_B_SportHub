<?php

namespace Tests\Feature;

use App\Models\AlatOlahraga;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AlatOlahragaTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $regularUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->regularUser = User::factory()->create([
            'role' => 'user',
        ]);
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get(route('alat-olahraga.index'));
        $response->assertRedirect('/login');
    }

    public function test_can_view_index_page_when_authenticated(): void
    {
        $response = $this->actingAs($this->regularUser)->get(route('alat-olahraga.index'));
        $response->assertStatus(200);
        $response->assertSee('Daftar Alat Olahraga');
    }

    public function test_regular_user_cannot_view_create_page(): void
    {
        $response = $this->actingAs($this->regularUser)->get(route('alat-olahraga.create'));
        $response->assertStatus(404);
    }

    public function test_admin_can_view_create_page(): void
    {
        $response = $this->actingAs($this->admin)->get(route('alat-olahraga.create'));
        $response->assertStatus(200);
        $response->assertSee('Tambah Alat Olahraga');
    }

    public function test_regular_user_cannot_store_alat_olahraga(): void
    {
        $payload = [
            'nama_alat'  => 'Bola Basket Molten GG7X',
            'kategori'   => 'Bola Basket',
            'kondisi'    => 'Baik',
            'tarif_sewa' => 30000,
            'stok'       => 8,
        ];

        $response = $this->actingAs($this->regularUser)->post(route('alat-olahraga.store'), $payload);
        $response->assertStatus(404);
    }

    public function test_admin_can_store_alat_olahraga(): void
    {
        $payload = [
            'nama_alat'  => 'Bola Basket Molten GG7X',
            'kategori'   => 'Bola Basket',
            'kondisi'    => 'Baik',
            'tarif_sewa' => 30000,
            'stok'       => 8,
        ];

        $response = $this->actingAs($this->admin)->post(route('alat-olahraga.store'), $payload);

        $response->assertRedirect(route('alat-olahraga.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('alat_olahragas', [
            'nama_alat' => 'Bola Basket Molten GG7X',
        ]);
    }

    public function test_validation_fails_when_storing_empty_data(): void
    {
        $response = $this->actingAs($this->admin)->post(route('alat-olahraga.store'), []);

        $response->assertSessionHasErrors(['nama_alat', 'kategori', 'kondisi', 'tarif_sewa', 'stok']);
    }

    public function test_regular_user_cannot_view_edit_page(): void
    {
        $alat = AlatOlahraga::create([
            'nama_alat'  => 'Raket Badminton Yonex',
            'kategori'   => 'Bulu Tangkis',
            'kondisi'    => 'Baik',
            'tarif_sewa' => 25000,
            'stok'       => 5,
        ]);

        $response = $this->actingAs($this->regularUser)->get(route('alat-olahraga.edit', $alat->id));
        $response->assertStatus(404);
    }

    public function test_admin_can_view_edit_page(): void
    {
        $alat = AlatOlahraga::create([
            'nama_alat'  => 'Raket Badminton Yonex',
            'kategori'   => 'Bulu Tangkis',
            'kondisi'    => 'Baik',
            'tarif_sewa' => 25000,
            'stok'       => 5,
        ]);

        $response = $this->actingAs($this->admin)->get(route('alat-olahraga.edit', $alat->id));
        $response->assertStatus(200);
        $response->assertSee('Raket Badminton Yonex');
    }

    public function test_regular_user_cannot_update_alat_olahraga(): void
    {
        $alat = AlatOlahraga::create([
            'nama_alat'  => 'Raket Badminton Yonex',
            'kategori'   => 'Bulu Tangkis',
            'kondisi'    => 'Baik',
            'tarif_sewa' => 25000,
            'stok'       => 5,
        ]);

        $payload = [
            'nama_alat'  => 'Raket Badminton Yonex Nanoray Updated',
            'kategori'   => 'Bulu Tangkis',
            'kondisi'    => 'Sangat Baik',
            'tarif_sewa' => 35000,
            'stok'       => 4,
        ];

        $response = $this->actingAs($this->regularUser)->put(route('alat-olahraga.update', $alat->id), $payload);
        $response->assertStatus(404);
    }

    public function test_admin_can_update_alat_olahraga(): void
    {
        $alat = AlatOlahraga::create([
            'nama_alat'  => 'Raket Badminton Yonex',
            'kategori'   => 'Bulu Tangkis',
            'kondisi'    => 'Baik',
            'tarif_sewa' => 25000,
            'stok'       => 5,
        ]);

        $payload = [
            'nama_alat'  => 'Raket Badminton Yonex Nanoray Updated',
            'kategori'   => 'Bulu Tangkis',
            'kondisi'    => 'Sangat Baik',
            'tarif_sewa' => 35000,
            'stok'       => 4,
        ];

        $response = $this->actingAs($this->admin)->put(route('alat-olahraga.update', $alat->id), $payload);

        $response->assertRedirect(route('alat-olahraga.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('alat_olahragas', [
            'id' => $alat->id,
            'nama_alat' => 'Raket Badminton Yonex Nanoray Updated',
        ]);
    }

    public function test_regular_user_cannot_delete_alat_olahraga(): void
    {
        $alat = AlatOlahraga::create([
            'nama_alat'  => 'Matras Yoga Kettler',
            'kategori'   => 'Fitness & Gym',
            'kondisi'    => 'Baik',
            'tarif_sewa' => 15000,
            'stok'       => 3,
        ]);

        $response = $this->actingAs($this->regularUser)->delete(route('alat-olahraga.destroy', $alat->id));
        $response->assertStatus(404);
    }

    public function test_admin_can_delete_alat_olahraga(): void
    {
        $alat = AlatOlahraga::create([
            'nama_alat'  => 'Matras Yoga Kettler',
            'kategori'   => 'Fitness & Gym',
            'kondisi'    => 'Baik',
            'tarif_sewa' => 15000,
            'stok'       => 3,
        ]);

        $response = $this->actingAs($this->admin)->delete(route('alat-olahraga.destroy', $alat->id));

        $response->assertRedirect(route('alat-olahraga.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('alat_olahragas', [
            'id' => $alat->id,
        ]);
    }
}
