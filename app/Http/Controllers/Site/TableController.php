<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CollabFormRequest;
use App\Http\Requests\ProcessoFormRequest;
use App\Models\Collaborators;
use App\Models\Processo;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Setor;

class TableController extends Controller
{
    /**
     * Lista os primeiros 20 registros do banco e retorna a view referente à tabela
     */
    public function index()
    {
        $collabs = Collaborators::orderBy('created_at', 'desc')->take(20)->get();
        return view('site.table.index', compact('collabs'));
    }

    /**
     * Realiza a busca no DB e retorna a view apenas com os contatos que deram match com o parâmetro de busca
     */
    public function search(Request $request)
    {
        $parameter = $request->input('parameter');
        $collabs = Collaborators::orderby('name')->where('name', 'like', "%$parameter%")
            ->orWhere('email', 'like', "%$parameter%")
            ->orWhere('matricula', 'like', "%$parameter%")
            ->orWhere('setor', 'like', "%$parameter%")
            ->orWhere('status', 'like', "%$parameter%")
            ->orWhereHas('processos', function ($query) use ($parameter) {
                $query->where('processo', 'like', "%$parameter%")
                ->orWhere('sensiveis', 'like', "%$parameter%")
                ->orWhere('sistemas', 'like', "%$parameter%");
            })
            ->with('processos')
            ->get();
    
        return view('site.table.index', compact('collabs'));
    }
    
    

    /**
     * Retorna os dados preenchidos no formulário
     */
    public function edit($id)
    {
        $setores = Setor::all();
        $collab = Collaborators::find($id);

        if (!$collab) {
            toastr()->error('Colaborador não encontrado.', 'Erro');
            return redirect()->route('site.table.index');
        }

        return view('site.table.edit', compact('collab', 'setores'));
    }

    /**
     * Realiza a atualização dos dados no banco de dados 
     */
    public function update(CollabFormRequest $request, $id)
    {
        $collab = Collaborators::find($id);
        
        $collab->fill($request->all());
        $collab->save();

        toastr()->success('Usuário atualizado com sucesso!', 'Sucesso');
        return view('site.table.update', compact('collab'));
    }

    /**
     * Deleta os dados do banco de dados 
     */
    public function destroy($id)
    {
        $collabs = Collaborators::find($id);

        if (!$collabs) {
            toastr()->error('Colaborador não encontrado.', 'Erro');
            return redirect()->route('site.table');
        }

        $collabs->processos()->delete();

        $collabs->delete();

        toastr()->info('Colaborador excluído com sucesso!', 'Informação:');
        return redirect()->route('site.table');
    }

    /**
     * Deleta os dados do banco de dados 
     */
    public function dash()
    {
        $total = Collaborators::count();

        return view('dashboard', compact('total'));
    }

    public function add()
    {
        return view('processos');
    }

    public function show($id)
    {
        $collab = Collaborators::find($id);
        $processos = $collab->processos;
    
        return view('site.table.show', compact('collab', 'processos'));
    }
    
}
