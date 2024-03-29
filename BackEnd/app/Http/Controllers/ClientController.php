<?php

namespace App\Http\Controllers;

use App\Repositories\ClientRepositorie;
use Illuminate\Http\Request;

class ClientController extends Controller
{
   function __construct(ClientRepositorie $repositorie)
   {
      $this->repo = $repositorie;
   }

   public function index(Request $request)
   {
      $dados = $this->repo->list($request);

      return response()->json($dados);
   }

   public function create(Request $request)
   {
      $request = $request->all();
      $dados = $this->repo->novo($request);

      if (is_array($dados)) {
         return response()->json($dados, 500);
      }

      return response()->json(['message' => "Cadastro realizado com sucesso!"], 201);
   }

   public function show(int $id)
   {
      $dados = $this->repo->getSingle($id);

      return response()->json($dados);
   }

   public function update(Request $request, int $id)
   {
      $request = $request->all();
      $dados = $this->repo->editar($request, $id);

      if (is_array($dados)) {
         return response()->json($dados, 500);
      }

      return response()->json(['message' => "Cadastro atualizado com sucesso!"], 201);
   }

   public function destroy(int $id)
   {
      $dados = $this->repo->delete($id);

      if (is_array($dados)) {
         return response()->json($dados, 500);
      }

      return response()->json(['message' => "Cadastro deletado com sucesso!"], 201);
   }
}
