<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterestedAccountRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InterestedAccountController extends Controller
{
    public function index(): View
    {
        return view('interessados.index', [
            'interessados' => User::where('is_admin', false)->orderBy('name')->paginate(10),
            'total' => User::where('is_admin', false)->count(),
        ]);
    }

    public function create(): View
    {
        return view('interessados.create');
    }

    public function store(InterestedAccountRequest $request): RedirectResponse
    {
        $interessado = User::create($request->validated());

        return redirect()->route('admin.interessados.show', $interessado)->with('success', 'Interessado cadastrado com sucesso.');
    }

    public function show(User $interessado): View
    {
        abort_if($interessado->is_admin, 404);

        return view('interessados.show', compact('interessado'));
    }

    public function edit(User $interessado): View
    {
        abort_if($interessado->is_admin, 404);

        return view('interessados.edit', compact('interessado'));
    }

    public function update(InterestedAccountRequest $request, User $interessado): RedirectResponse
    {
        abort_if($interessado->is_admin, 404);
        $data = $request->validated();

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $interessado->update($data);

        return redirect()->route('admin.interessados.show', $interessado)->with('success', 'Interessado atualizado com sucesso.');
    }

    public function destroy(User $interessado): RedirectResponse
    {
        abort_if($interessado->is_admin, 404);
        $interessado->delete();

        return redirect()->route('admin.interessados.index')->with('success', 'Interessado excluído com sucesso.');
    }
}
