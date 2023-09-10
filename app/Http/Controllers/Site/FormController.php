<?php

namespace App\Http\Controllers\Site;

use App\Models\Collaborators;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CollabFormRequest;
use App\Models\Setor;
use App\Models\Colaborador;


class FormController extends Controller
{
    /**
     * Retorna a view do formulário
     */
    public function index()
    {
        return view('site.formulario.index');
    }

    /**
     * Processa o formulário enviado, cria um registro no BD e mostra mensagens de sucesso ou erro
     */
    public function formulario(CollabFormRequest $request)
    {
        // Obter os valores enviados pelo formulário
        $name = $request->input('name');
        $email = $request->input('email');
        $matricula = $request->input('matricula');

        // Verificar se já existe um colaborador com os mesmos valores de name, email e matricula
        $existingCollaborator = Collaborators::where('name', $name)
            ->orWhere('email', $email)
            ->orWhere('matricula', $matricula)
            ->first();

        // Se um colaborador com esses dados já existir, exibir mensagem de erro e redirecionar para o formulário
        if ($existingCollaborator) {
            toastr()->error('Esses dados já existem', 'Erro');
            return redirect()->route('site.formulario');
        }

        // Criar um novo registro de colaborador no BD usando os dados do formulário
        $collaborator = Collaborators::create($request->all());

        // Verificar se o registro foi criado com sucesso
        if (!$collaborator) {
            toastr()->error('Erro', 'Falha ao salvar o formulário');
            return redirect()->route('site.formulario.index');
        }

        // Exibir mensagem de sucesso e redirecionar para a tabela de registros
        toastr()->success('O formulário foi salvo', 'Parabéns');
        return redirect()->route('site.table');
    }

    /**
     * Exibe o formulário juntamente com dados adicionais (setores e colaboradores) para seleção
     */
    public function exibirFormulario()
    {
        // Obter todos os setores e colaboradores do BD
        $setores = Setor::all();
        $colaboradores = Colaborador::all();

        // Retornar a view do formulário com os dados obtidos
        return view('site.formulario.index', compact('setores', 'colaboradores'));
    }
}

