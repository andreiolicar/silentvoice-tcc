<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_registration_saves_interest_but_cannot_grant_admin_access(): void
    {
        $this->post('/register', [
            'name' => 'Pessoa Interessada', 'email' => 'pessoa@example.test',
            'password' => 'SilentVoice123!', 'password_confirmation' => 'SilentVoice123!',
            'interest_type' => 'investidor', 'is_admin' => true,
        ])->assertSessionHasNoErrors()->assertRedirect('/dashboard');
        $account = User::where('email', 'pessoa@example.test')->firstOrFail();
        $this->assertFalse($account->is_admin);
        $this->assertSame('investidor', $account->interest_type);
    }

    public function test_public_registration_requires_a_valid_interest_type(): void
    {
        foreach ([null, 'administrador'] as $type) {
            $this->post('/register', [
                'name' => 'Pessoa', 'email' => 'pessoa@example.test',
                'password' => 'SilentVoice123!', 'password_confirmation' => 'SilentVoice123!',
                'interest_type' => $type,
            ])->assertSessionHasErrors('interest_type');
        }
        $this->assertDatabaseCount('users', 0);
    }

    public function test_profile_update_changes_only_the_authenticated_account(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $this->actingAs($owner)->patch('/profile', [
            'id' => $other->id, 'name' => 'Nome Atualizado', 'email' => 'atualizado@example.test',
            'interest_type' => 'investidor', 'is_admin' => true,
        ])->assertSessionHasNoErrors()->assertRedirect('/profile');
        $this->assertDatabaseHas('users', ['id' => $owner->id, 'interest_type' => 'investidor', 'is_admin' => false]);
        $this->assertSame($other->name, $other->fresh()->name);
        $this->assertSame($other->email, $other->fresh()->email);
    }

    public function test_profile_update_rejects_duplicate_email_and_invalid_interest(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $this->actingAs($owner)->patch('/profile', [
            'name' => 'Atualizado', 'email' => $other->email, 'interest_type' => 'invalido',
        ])->assertSessionHasErrors(['email', 'interest_type']);
        $this->assertSame($owner->email, $owner->fresh()->email);
    }

    public function test_admin_cannot_delete_their_account_through_profile(): void
    {
        $admin = User::factory()->create(['is_admin' => true, 'interest_type' => null]);
        $this->actingAs($admin)->delete('/profile', ['password' => 'password'])->assertForbidden();
        $this->assertNotNull($admin->fresh());
    }

    public function test_guests_cannot_access_the_dashboard_or_profile(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
        $this->get('/profile')->assertRedirect('/login');
    }
}
