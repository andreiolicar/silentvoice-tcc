<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class InterestedAccountTest extends TestCase
{
    use RefreshDatabase;

    private function administrator(): User
    {
        return User::factory()->create(['is_admin' => true, 'interest_type' => null]);
    }

    private function accountData(array $overrides = []): array
    {
        return array_replace([
            'name' => 'Marina de Demonstração',
            'email' => 'marina@example.test',
            'interest_type' => 'investidor',
            'password' => 'SilentVoice123!',
            'password_confirmation' => 'SilentVoice123!',
        ], $overrides);
    }

    public function test_admin_can_create_read_update_and_delete_an_interested_account(): void
    {
        $this->actingAs($this->administrator());

        $this->get('/admin/interessados/create')->assertOk();
        $this->post('/admin/interessados', $this->accountData(['is_admin' => true]))
            ->assertSessionHasNoErrors()->assertRedirect();
        $account = User::where('email', 'marina@example.test')->firstOrFail();
        $this->assertFalse($account->is_admin);
        $this->assertTrue(Hash::check('SilentVoice123!', $account->password));
        $this->assertDatabaseHas('users', ['id' => $account->id, 'interest_type' => 'investidor']);

        $this->get('/admin/interessados')->assertOk()->assertSee('Marina de Demonstração');
        $this->get('/admin/interessados/'.$account->id)->assertOk()->assertSee('marina@example.test');
        $this->get('/admin/interessados/'.$account->id.'/edit')->assertOk();

        $oldHash = $account->password;
        $this->put('/admin/interessados/'.$account->id, $this->accountData([
            'name' => 'Marina Atualizada', 'interest_type' => 'usuario',
            'password' => '', 'password_confirmation' => '', 'is_admin' => true,
        ]))->assertSessionHasNoErrors()->assertRedirect();
        $this->assertDatabaseHas('users', ['id' => $account->id, 'name' => 'Marina Atualizada', 'interest_type' => 'usuario', 'is_admin' => false]);
        $this->assertSame($oldHash, $account->fresh()->password);

        $this->delete('/admin/interessados/'.$account->id)->assertRedirect('/admin/interessados');
        $this->assertDatabaseMissing('users', ['id' => $account->id]);
    }

    public function test_admin_can_change_an_interested_accounts_password(): void
    {
        $account = User::factory()->create();
        $this->actingAs($this->administrator())->put('/admin/interessados/'.$account->id,
            $this->accountData(['password' => 'NovaSenha123!', 'password_confirmation' => 'NovaSenha123!'])
        )->assertSessionHasNoErrors()->assertRedirect();
        $this->assertTrue(Hash::check('NovaSenha123!', $account->fresh()->password));
    }

    public function test_guest_cannot_access_any_admin_crud_action(): void
    {
        foreach ([['get', ''], ['get', '/create'], ['post', ''], ['get', '/1'], ['get', '/1/edit'], ['put', '/1'], ['delete', '/1']] as [$method, $suffix]) {
            $this->{$method}('/admin/interessados'.$suffix, $this->accountData())->assertRedirect('/login');
        }
    }

    public function test_interested_user_cannot_access_any_admin_crud_action(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        foreach ([['get', ''], ['get', '/create'], ['post', ''], ['get', '/'.$user->id], ['get', '/'.$user->id.'/edit'], ['put', '/'.$user->id], ['delete', '/'.$user->id]] as [$method, $suffix]) {
            $this->{$method}('/admin/interessados'.$suffix, $this->accountData())->assertForbidden();
        }
        $this->assertDatabaseHas('users', ['id' => $user->id, 'email' => $user->email]);
        $this->assertDatabaseCount('users', 1);
    }

    public function test_administrators_are_excluded_from_the_interested_crud(): void
    {
        $admin = $this->administrator();
        $this->actingAs($admin)->get('/admin/interessados')->assertOk()->assertDontSee($admin->email);
        $this->get('/admin/interessados/'.$admin->id)->assertNotFound();
        $this->get('/admin/interessados/'.$admin->id.'/edit')->assertNotFound();
        $this->put('/admin/interessados/'.$admin->id, $this->accountData())->assertNotFound();
        $this->delete('/admin/interessados/'.$admin->id)->assertNotFound();
        $this->assertNotNull($admin->fresh());
    }

    public function test_invalid_create_does_not_write_to_the_database(): void
    {
        $existing = User::factory()->create();
        $this->actingAs($this->administrator())->post('/admin/interessados', $this->accountData([
            'name' => '', 'email' => $existing->email, 'interest_type' => 'invalido',
            'password' => '123', 'password_confirmation' => 'diferente',
        ]))->assertSessionHasErrors(['name', 'email', 'interest_type', 'password']);
        $this->assertDatabaseCount('users', 2);
    }

    public function test_duplicate_email_cannot_overwrite_an_existing_account(): void
    {
        $existing = User::factory()->create();
        $account = User::factory()->create();
        $this->actingAs($this->administrator())->put('/admin/interessados/'.$account->id,
            $this->accountData(['email' => $existing->email])
        )->assertSessionHasErrors('email');
        $this->assertSame($account->email, $account->fresh()->email);
    }

    public function test_nonexistent_interested_account_returns_404(): void
    {
        $this->actingAs($this->administrator())->get('/admin/interessados/9999')->assertNotFound();
    }
}
