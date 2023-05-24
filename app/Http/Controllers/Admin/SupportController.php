<?php

namespace App\Http\Controllers\Admin;

use App\Models\Support;
use Illuminate\Http\Request;
use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Services\SupportService;
use App\Http\Controllers\Controller;
use App\Http\Requests\SupportRequest;


class SupportController extends Controller
{
    public function __construct(protected SupportService $supportService)
    {
    }

    public function index(Request $request)
    {
        $supports = $this->supportService->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter
        );
        return view('admin.supports.index', compact('supports'));
    }

    public function create()
    {
        return view('admin.supports.create');
    }

    public function store(SupportRequest $request)
    {
        $this->supportService->create(CreateSupportDTO::makeFromRequest($request));
        return redirect()->route('supports.index')
            ->with('message', 'Cadastrado com sucesso!');
    }

    public function show($id)
    {
        if (!$support = Support::find($id)) {
            return back();
        }
        return view('admin.supports.show', compact('support'));
    }

    public function edit($id)
    {
        if (!$support = Support::find($id)) {
            return back();
        }
        return view('admin.supports.edit', compact('support'));
    }

    public function update(SupportRequest $request, $id)
    {

        $support = $this->supportService->update(UpdateSupportDTO::makeFromRequest($request));
        if (!$support) {
            return back();
        }
        return redirect()->route('supports.index')
            ->with('message', 'Atualizado com sucesso!');
    }

    public function destroy($id)
    {
        if (!$support = Support::find($id)) {
            return back();
        }
        $support->delete();
        return redirect()->route('supports.index')
            ->with('message', 'Deletado com sucesso!');
    }
}
