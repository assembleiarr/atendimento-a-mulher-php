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
        $atendimentos = Atendimento::with('assistido', 'assistido.pessoa','areas')->orderBy('id', 'desc')->get();

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
        return Inertia::render('Atendimento/Create', [
            'areas' => \App\Models\Area::all()->pluck('nome', 'id'),
        ]);
    }

    public function importar()
    {
        $estados = \App\Models\Estado::where('is_estrangeiro', false)
            ->get()
            ->pluck('nome','id');

        return Inertia::render('Atendimento/Importar', [
            'estados' => $estados,
            'areas' => \App\Models\Area::all()->pluck('nome', 'id'),
            'letras' => range('A', 'Z'),
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

    public function cadastrar(StoreAtendimentoRequest $request, $tipo){

        $exists_pessoa = \App\Models\Pessoa::where('cpf', preg_replace("/[^0-9]/","", $request->get('cpf')))->first();

        if($exists_pessoa){
            $exists_pessoa->nome = $request->get('nome');
            $exists_pessoa->telefone_principal = $request->get('telefone_principal');

            $exists_pessoa->save();

            $pessoa = $exists_pessoa;
        }else{
            $pessoa = \App\Models\Pessoa::create([
                'nome' => $request->get('nome'),
                'cpf' => $request->get('cpf'),
                'telefone_principal' => $request->get('telefone_principal'),
             ]);

             $assistido = $pessoa->assistido()->create();
        }

        $atendimento = \App\Models\Atendimento::create([
            'assistido_id' => $pessoa->assistido->id,
            'recepcao_tipo' => $tipo,
            'is_importado' => false,
            'data_atendimento' => $request->get('data_atendimento'),
            'hora_atendimento' => $request->get('hora_h').":".$request->get('hora_m'),
            'observacoes' => $request->get('observacoes'),
        ]);   

        $atendimento->areas()->attach($request->get('areas'));
     
        return redirect()->route('atendimentos')->with('success', 'Atendimento cadastrado com sucesso.');

    }


    public function store(StoreAtendimentoRequest $request)
    {      
        $exists_pessoa = \App\Models\Pessoa::where('cpf', preg_replace("/[^0-9]/","", $request->get('cpf')))->first();

        if ($exists_pessoa)
        {
            $exists_pessoa->nome = $request->get('nome');
            $exists_pessoa->telefone_principal = $request->get('telefone_principal');
            
            $exists_pessoa->save();           

            if($exists_pessoa->endereco)
            {            
                $exists_pessoa->endereco()->update([
                    'logradouro' => mb_strtoupper($request->get('logradouro'),'UTF-8'),
                    'numero' => mb_strtoupper($request->get('numero'),'UTF-8'),
                    'bairro' => mb_strtoupper($request->get('bairro'),'UTF-8'),
                    'complemento' => mb_strtoupper($request->get('complemento'),'UTF-8'),
                    'municipio_id' => $request->get('municipio_id'),        
                ]);
            }
          
            if($exists_pessoa->assistido){               
                
                $exists_pessoa->assistido()->update([
                    'local_arquivo' => $request->get('local_arquivo_id')."-".$request->get('local_arquivo_letra')
                ]);
            }

            $pessoa = $exists_pessoa;

        }else{
            $pessoa = \App\Models\Pessoa::create([
                'nome' => $request->get('nome'),
                'cpf' => $request->get('cpf'),
                'data_nascimento' => $request->get('data_nascimento'),
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

            $assistido = $pessoa->assistido()->create([              
                'local_arquivo' => $request->get('local_arquivo_id')."-".$request->get('local_arquivo_letra'),
            ]);
        }       

        $atendimento = \App\Models\Atendimento::create([
            'assistido_id' => $pessoa->assistido->id,
            'recepcao_tipo' => $request->get('recepcao_tipo'),
            'is_importado' => $request->get('is_importado'),
            'data_atendimento' => $request->get('data_atendimento'),
        ]);   

        $atendimento->areas()->attach($request->get('areas'));
     
        return redirect()->route('atendimentos')->with('success', 'Atendimento cadastrado com sucesso.');
       
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
