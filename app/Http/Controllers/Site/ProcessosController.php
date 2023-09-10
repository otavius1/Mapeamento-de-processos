<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Processo;
use App\Models\Collaborators;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProcessoFormRequest;
use App\Models\Base;
use App\Models\Dado;
use App\Models\Sistema;

class ProcessosController extends Controller
{
    public function index()
    {
        return view('site.processos.index');
    }

    public function processoForm(ProcessoFormRequest $request)
    {
        $data = $request->all();
        $collaboratorId = $data['collaborator_id'];

        $collaborator = Collaborators::findOrFail($collaboratorId);

        $processo = new Processo($data);
        $processo->tempo = $data['time_number'] . ' ' . $data['time_unit'];

        // Verifique se os campos existem e, em seguida, atribua o valor formatado
        if (isset($data['sistemas'])) {
            $processo->sistemas = implode(', ', $data['sistemas']);
        }
        if (isset($data['bases'])) {
            $processo->bases = implode(', ', $data['bases']);
        }
        if (isset($data['dados'])) {
            $processo->dados = implode(', ', $data['dados']);
        }

        $collaborator->processos()->save($processo);

        toastr()->success('O formulário foi salvo', 'Parabéns');

        return back();
    }

    public function listProcessos($id)
    {
        $collab = Collaborators::findOrFail($id);
        $processos = $collab->processos;

        return view('site.processos.list', compact('processos', 'collab'));
    }

    public function edit($id, $pid)
    {
        $collab = Collaborators::findOrFail($id);
        $processo = $collab->processos->find($pid);
        $sistemas = Sistema::all();
        $dados = Dado::all();
        $bases = Base::all();

        return view('site.processos.edit', compact('sistemas', 'dados', 'bases','processo', 'collab'));
    }

    public function update(ProcessoFormRequest $request, $id)
    {
        $processo = Processo::find($id);

        if (!$processo) {
            toastr()->error('Processo não encontrado.', 'Erro');
            return redirect()->route('processos');
        }

        $data = $request->all();
        $data['tempo'] = $data['time_number'] . ' ' . $data['time_unit'];

        // Verifique se os campos existem e, em seguida, atribua o valor formatado
        if (isset($data['sistemas'])) {
            $data['sistemas'] = implode(', ', $data['sistemas']);
        }
        if (isset($data['bases'])) {
            $data['bases'] = implode(', ', $data['bases']);
        }
        if (isset($data['dados'])) {
            $data['dados'] = implode(', ', $data['dados']);
        }

        $processo->update($data);

        toastr()->success('Processo atualizado com sucesso!', 'Sucesso');
        return redirect()->route('site.table');
    }

    public function exibirSelects()
    {
        $sistemas = Sistema::all();
        $dados = Dado::all();
        $bases = Base::all();
        return view('site.processos.form', compact('sistemas', 'dados', 'bases'));
    }
    
    public function showProcessoForm($collaboratorId)
    {
        $collaborator = Collaborators::findOrFail($collaboratorId);
        $sistemas = $this->exibirSelects()['sistemas'];
        $dados = $this->exibirSelects()['dados'];
        $bases = $this->exibirSelects()['bases'];
        return view('site.processos.form', compact('sistemas', 'dados', 'bases','collaborator'));
    }

    public function destroy($id)
    {
        $processo = Processo::find($id);

        $processo->delete();

        toastr()->info('Processo excluído com sucesso!', 'Informação:');
        return redirect()->route('site.table');
    }

    public function search(Request $request)
    {
        $processos = Processo::query();

        // Aplicar filtros
        if ($request->has('processo')) {
            $processos->where('processo', 'like', '%' . $request->input('processo') . '%');
        }

        if ($request->has('descricao')) {
            $processos->where('descricao', 'like', '%' . $request->input('descricao') . '%');
        }

        if ($request->has('sistemas')) {
            $processos->where('sistemas', 'like', '%' . $request->input('sistemas') . '%');
        }

        if ($request->has('sensiveis')) {
            $processos->where('sensiveis', $request->input('sensiveis'));
        }

        if ($request->has('tempo')) {
            $processos->where('tempo', 'like', '%' . $request->input('tempo') . '%');
        }

        if ($request->has('bases')) {
            $processos->where('bases', 'like', '%' . $request->input('bases') . '%');
        }

        if ($request->has('dados')) {
            $processos->where('dados', 'like', '%' . $request->input('dados') . '%');
        }

        $processos = $processos->get();

        return view('processos.search', compact('processos'));
    }


}
