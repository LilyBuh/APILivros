<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livros;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class LivrosController extends Controller
{
  
    public function index()
    {
        $dadosLivro = Livros::All();

        return 'Nenhum Livro Encontrado' .$dadosLivro;
    }

   
    public function store(Request $request)
    {
        $dadosLivro = $request -> All();
        $valida = Validator::make($dadosLivro,[
            'titulo' => 'required',
            'autor' => 'required'
        ]);

        if($valida->fails()){
            return 'Dados incompletos '.$valida->errors(true). 500;
        }

        $RegistroLivro = Livros::create($dadosLivro);
        if($RegistroLivro){
            return 'Dados cadastro com sucesso.';
        }else{
            return 'Erro ao cadastrar dados. Tente Novamente.';
        }
    }

    public function show(string $id)
    {
        $dadosLivro = Livros::find($id);
        $contador = $dadosLivro->count();
        if($dadosLivro){
            return 'Livro Encontrado'.$contador.' - ' .$dadosLivro.response()->json([],Response::HTTP_NO_CONTENT);
        }else {
            return 'Livro não Encontrado.'.response()->json([],Response::HTTP_NO_CONTENT);
        }   
    }

    public function update(Request $request, string $id)
    {
        $dadosLivro = $request->all();
        $valida = validator::make($dadosLivro,[
            'titulo' => 'required',
            'autor' => 'required'
        ]);

        if($valida->fails()){
            return 'Erro Validação!'.$valida->errors();
        }
        $dadosLivroBank = Livros::find($id);
        $dadosLivroBank->titulo = $dadosLivro['titulo'];
        $dadosLivroBank->autor = $dadosLivro['autor'];

        $enviolivro = $dadosLivroBank->save();
        
        if($enviolivro){
            return 'Alteração feita com sucesso.'.response()->json([],Response::HTTP_NO_CONTENT);
        }else {
            return 'Alteração não realizada com sucesso.'.response()->json([],Response::HTTP_NO_CONTENT);
        }
    }

    public function destroy(string $id)
    {
        $dadosLivro = Livros::find($id);
        if($dadosLivro){
            $dadosLivro->delete();
            return 'Livro Deletado com Sucesso.'.response()->json([],Response::HTTP_NO_CONTENT);
        }else {
            return 'Livro Não Deletado.'.response()->json([],Response::HTTP_NO_CONTENT);
        }
    }
}
