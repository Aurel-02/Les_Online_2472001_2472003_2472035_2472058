<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PTNSecurityTest extends TestCase
{
    use DatabaseTransactions;

    public function test_sd_student_cannot_access_ptn_and_jurusan()
    {
        $user = User::create([
            'nama' => 'Siswa SD',
            'email' => 'sd@pintar.id',
            'password' => bcrypt('password'),
            'role' => 'siswa',
            'id_jenjang' => 1,
        ]);

        $this->actingAs($user);

        $response = $this->get('/siswa/ptn');
        $response->assertStatus(403);

        $response = $this->get('/siswa/fakultas');
        $response->assertStatus(403);

        $response = $this->get('/siswa/rekomendasi');
        $response->assertStatus(403);

        $response = $this->get('/siswa/jurusan/detail');
        $response->assertStatus(403);
    }

    public function test_smp_student_cannot_access_ptn_and_jurusan()
    {
        $user = User::create([
            'nama' => 'Siswa SMP',
            'email' => 'smp@pintar.id',
            'password' => bcrypt('password'),
            'role' => 'siswa',
            'id_jenjang' => 2,
        ]);

        $this->actingAs($user);

        $response = $this->get('/siswa/ptn');
        $response->assertStatus(403);

        $response = $this->get('/siswa/fakultas');
        $response->assertStatus(403);

        $response = $this->get('/siswa/rekomendasi');
        $response->assertStatus(403);

        $response = $this->get('/siswa/jurusan/detail');
        $response->assertStatus(403);
    }

    public function test_sma_student_can_access_ptn_and_jurusan()
    {
        $user = User::create([
            'nama' => 'Siswa SMA',
            'email' => 'sma@pintar.id',
            'password' => bcrypt('password'),
            'role' => 'siswa',
            'id_jenjang' => 3,
        ]);

        $this->actingAs($user);

        $response = $this->get('/siswa/ptn');
        $response->assertStatus(200);

        $response = $this->get('/siswa/fakultas');
        $response->assertStatus(200);

        $response = $this->get('/siswa/rekomendasi');
        $response->assertStatus(200);

        $response = $this->get('/siswa/jurusan/detail');
        $response->assertStatus(200);
    }
}
