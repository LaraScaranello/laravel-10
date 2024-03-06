<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupportRequest;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function __construct(
        protected SupportService $service
    ) {}

    public function index(Request $request)
    {
        $supports = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter,
        );

        $filters = ['filter' => $request->get('filter', '')];

        return view('admin/supports/index', compact('supports', 'filters'));
    }

    public function create()
    {
        return view('admin/supports/create');
    }

    public function store(StoreUpdateSupportRequest $request, Support $support)
    {
        $this->service->new(CreateSupportDTO::makeFromRequest($request));

        return redirect()
                ->route('supports.index')
                ->with('message', 'Cadastrado com Sucesso!');
    }

    public function show(string $id)
    {
        if (!$support = $this->service->findOne($id)) {
            return back();
        }

        return view('admin/supports/show', compact('support'));
    }

    public function edit(string $id)
    {
        if (!$support = $this->service->findOne($id)) {
            return back();
        }
        return view('admin/supports.edit', compact('support'));
    }

    public function update(StoreUpdateSupportRequest $request, Support $support, string $id)
    {
        $this->service->update(UpdateSupportDTO::makeFromRequest($request));

        if (!$support = $support->where('id', $id)->first()) {
            return back();
        }

        return redirect()
                    ->route('supports.index')
                    ->with('message', 'Atualizado com Sucesso!');
    }

    public function destroy(Support $support, string|int $id)
    {
        $this->service->delete($id);

        return redirect()
                    ->route('supports.index')
                    ->with('message', 'Excluído com Sucesso!');
    }
}
