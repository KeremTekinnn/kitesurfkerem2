<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Reservation;
use Livewire\Livewire;
use App\Livewire\Instructor\ClientEditModal;

class ClientEditModalTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_client()
    {
        // Seeder'ları çalıştır
        $this->seed(\Database\Seeders\LocationSeeder::class);
        $this->seed(\Database\Seeders\CourseSeeder::class);
        // Instructor rolünde bir kullanıcı oluştur
        $instructor = User::factory()->create(['role' => 'instructor']);

        // Client rolünde bir kullanıcı oluştur
        $client = User::factory()->create(['role' => 'client']);

        // Rezervasyon oluştur
        $reservation = Reservation::factory()->create([
            'instructor_id' => $instructor->id,
            'client_id' => $client->id,
            'course_id' => 1,
            'date' => '2024-05-15',
            'status' => 'booked',
            'location_id' => 1,
            'start_time' => '08:00:00',
            'end_time' => '10:30:00'
        ]);
        // Login as instructor
        $this->actingAs($instructor);

        Livewire::test(ClientEditModal::class, ['user' => $client])
            ->set('user.name', 'New Name')
            ->call('update');

        $this->assertDatabaseHas('users', ['id' => $client->id, 'name' => 'New Name']);
    }
}
