<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GuruTest extends TestCase
{
    use DatabaseTransactions;

    private function createGuru()
    {
        return User::create([
            'nama' => 'Guru Test',
            'email' => 'gurutest@pintar.id',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);
    }

    /**
     * Test that all task management routes return 404.
     */
    public function test_guru_cannot_access_any_tugas_routes()
    {
        $guru = $this->createGuru();
        $this->actingAs($guru);

        // All these routes should return 404 since they were completely deleted
        $response = $this->get('/guru/tugas');
        $response->assertStatus(404);

        $response = $this->get('/guru/tugas/create');
        $response->assertStatus(404);

        $response = $this->post('/guru/tugas', [
            'judul' => 'Tugas Baru',
            'deskripsi' => 'Deskripsi',
        ]);
        $response->assertStatus(404);

        $response = $this->get('/guru/tugas/1/edit');
        $response->assertStatus(404);
    }

    /**
     * Test that the student list displays "Jenjang", does NOT display "Peran", and the sidebar is correct.
     */
    public function test_guru_siswa_page_displays_jenjang_and_correct_sidebar_without_peran()
    {
        $guru = $this->createGuru();
        $this->actingAs($guru);

        $response = $this->get('/guru/siswa');
        $response->assertStatus(200);

        // Check if "Jenjang" header is present
        $response->assertSee('Jenjang');

        // Check that "Peran" column and badge are not present
        $response->assertDontSee('Peran');
        $response->assertDontSee('badge-role');

        // Check if "Siswa" is present in the sidebar but NOT "Kelas & Siswa" or tasks link
        $response->assertSee('Siswa');
        $response->assertDontSee('Kelas & Siswa');
        $response->assertDontSee('/guru/tugas');
    }
}
