<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Http\Requests\StoreAtendimentoRequest;
use App\Models\Atendimento;

class AtendimentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $atendimentos = Atendimento::with('assistido', 'assistido.pessoa')->paginate(10);

        return Inertia::render('Atendimento/Index', [
            'atendimentos' => $atendimentos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Atendimento/Create');
    }

    public function importar()
    {
        $estados = \App\Models\Estado::where('is_estrangeiro', false)
            ->get()
            ->pluck('nome','id');

        return Inertia::render('Atendimento/Importar', [
            'estados' => $estados,
        ]);
    }

    public function municipios($estado_id)
    {
        $municipios = \App\Models\Municipio::where('estado_id', $estado_id)
            ->orderBy('nome')
            ->get()
            ->pluck('nome','id');

        return $municipios;
    }

    public function paises()
    {
        $estado_id = \App\Models\Estado::where('is_estrangeiro', true)->first()->id;

        $paises = \App\Models\Municipio::where('estado_id', $estado_id)
            ->orderBy('nome')
            ->get()
            ->pluck('nome','id');

        return $paises;
    }


    public function store(StoreAtendimentoRequest $request)
    {

        $pessoa = \App\Models\Pessoa::create([
           'nome' => $request->get('nome'),
           'cpf' => $request->get('cpf'),
           'telefone_principal' => $request->get('telefone_principal'),
        ]);

        $endereco = $pessoa->endereco()->create([
            'cep' => $request->get('cep'),
            'logradouro' => $request->get('logradouro'),
            'numero' => $request->get('numero'),
            'bairro' => $request->get('bairro'),
            'complemento' => $request->get('complemento'),
            'municipio_id' => $request->get('municipio_id'),        
        ]);

        $assistido = \App\Models\Assistido::create([
            'pessoa_id' => $pessoa->id,
            'local_arquivo' => $request->get('local_arquivo'),
        ]);
        
        $atendimento = \App\Models\Atendimento::create([
            'assistido_id' => $assistido->id,
            'recepcao_tipo' => $request->get('recepcao_tipo'),
            'is_importado' => $request->get('is_importado')
        ]);        

        return redirect()->route('atendimentos')->with('success', 'Atendimento cadastrado.');
       
    }


    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

 
    public function destroy($id)
    {
        //
    }
}
