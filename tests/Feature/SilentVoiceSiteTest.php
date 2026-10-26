<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SilentVoiceSiteTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_and_dashboard_present_the_project_content(): void
    {
        $user = User::factory()->unverified()->create();
        foreach ([$this->get('/'), $this->actingAs($user)->get('/dashboard')] as $response) {
            $response->assertOk()->assertSee('EMG')->assertSee('visão computacional')
                ->assertSee('IA de borda')->assertSee('Perguntas frequentes')
                ->assertSee('contato@silentvoice.com.br');
        }
    }

    public function test_home_does_not_disclose_interested_accounts(): void
    {
        User::factory()->create(['email' => 'privado@example.test']);
        $this->get('/')->assertOk()->assertDontSee('privado@example.test');
    }

    public function test_unknown_route_returns_a_useful_custom_404(): void
    {
        $this->get('/pagina-inexistente')->assertNotFound()->assertSee('Voltar ao início');
    }

    public function test_seeder_creates_ten_interested_accounts_and_one_admin_without_duplicates(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->seed(DatabaseSeeder::class);
        $this->assertDatabaseCount('users', 11);
        $this->assertSame(10, User::where('is_admin', false)->count());
        $this->assertSame(1, User::where('is_admin', true)->count());
        $this->assertDatabaseHas('users', ['interest_type' => 'usuario']);
        $this->assertDatabaseHas('users', ['interest_type' => 'investidor']);
        $this->assertDatabaseHas('users', ['interest_type' => 'outro']);
    }
}
