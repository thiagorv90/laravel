<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contato;
use DB;
use App\Models\Instancia;

class ContatoController extends Controller
{
    /*Criação de um novo contato */

    public function contastore(Request $request, $id)
    {
        $events = new Contato;

        $events->cdInstancia = $request->cdInstancia;
        $events->tpContatoRepresentante = $request->tpContatoRepresentante;
        $events->nmContato = $request->nmContato;
        $events->dsEmail = $request->dsEmail;
        $events->dsEmailAlternativo = $request->dsEmailAlternativo;
        $events->stAtivo = $request->stAtivo;

        $events->save();

        return back();
    }

    public function contacreate()
    {
        /* Select dos dados das tabelas da instancias e contatos , para criar um contato */
        $contatos = DB::table('instancias')->get();
        $events = Contato::all();

        return view('contatos\contatos', compact('contatos', 'events'));
    }

    public function contalista($id)
    {
        /*Select da lista de contatos  */
        $contatos = DB::table('instancias')->join('contatos', 'contatos.cdInstancia', '=', 'instancias.cdInstancia')->where('instancias.cdInstancia', '=', $id)->get();
        $edit = Contato::join('instancias', 'contatos.cdInstancia', '=', 'instancias.cdInstancia')->join('instituicoes', 'instituicoes.cdInstituicao', '=', 'instancias.cdInstituicao')
            ->where('contatos.cdInstancia', '=', $id)
            ->get(['cdContato', 'instancias.cdInstancia', 'nmInstancia', 'nmContato', 'instancias.cdInstituicao']);
        $nome = DB::table('instancias')->where('instancias.cdInstancia', '=', $id)->get(['nmInstancia', 'cdInstancia']);
        $instancia = DB::table('instancias')->where('instancias.cdInstancia', '=', $id)->get(['nmInstancia', 'cdInstancia']);
        $bread = DB::table('instituicoes')->join('instancias', 'instituicoes.cdInstituicao', '=', 'instancias.cdInstituicao')->leftjoin('contatos', 'contatos.cdInstancia', '=', 'instancias.cdInstancia')
            ->where('instancias.cdInstancia', '=', $id)->first(['nmInstancia', 'nmInstituicao', 'instancias.cdInstituicao']);


        return view('contatos.listacontato', ['selecionado' => $edit, 'contatos' => $contatos, 'nome' => $nome, 'instancia' => $instancia, 'bread' => $bread]);

    }

    public function editCon($id)
    {
        /* Select dos contatos para editar*/
        $edit = contato::join('instancias', 'contatos.cdInstancia', '=', 'instancias.cdInstancia')
            ->where('cdContato', '=', $id)
            ->get(['nmContato', 'contatos.cdInstancia', 'dsEmail', 'nmInstancia', 'contatos.stAtivo', 'tpContatoRepresentante', 'dsEmailAlternativo', 'contatos.cdContato']);

        return view('contatos.edit', ['selecionado' => $edit]);
    }

    public function updateCon(Request $request, $id)
    {
        /* Update dos contatos  */
        $cd = $request->input('cdInstancia');
        $con = $request->input('tpContatoRepresentante');
        $name = $request->input('nmContato');
        $email = $request->input('dsEmail');
        $emaila = $request->input('dsEmailAlternativo');
        $ativo = $request->input('stAtivo');

        DB::update('update contatos set cdInstancia = ?, tpContatoRepresentante = ?, nmContato = ?, dsEmail = ?, dsEmailAlternativo = ?, stAtivo = ?
        where cdContato = ?', [$cd, $con, $name, $email, $emaila, $ativo, $id]);

        return redirect()->route('contatos', ['id' => $cd]);
    }

    public function search(Request $request, $id)
    {
        /*Search dos contatos  */
        $request->validate([
            'query' => 'required',
        ]);

        $query = $request->input('query');
        $events = DB::table('contatos')
            ->select('nmContato', 'cdContato', 'cdInstancia')
            ->where('nmContato', 'like', "%$query%")
            ->where('cdInstancia', '=', $id)
            ->get();

        return view('/contatos/search-results', compact('events'));
    }
}
