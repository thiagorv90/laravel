<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use DB;
use Illuminate\Support\Facades\Auth;


class EventController extends Controller
{
    public function editEmp($emp)
    {
        //$events = Empresas::all();
        $event = empresa::find($emp);

        return view('/empresas.edit', ['empresas' => $event]);
    }

    public function store(Request $request)
    {
        $event = new Empresa;
        $event->nmEmpresa = $request->nmEmpresa;
        $event->save();

        return redirect('/empresas');
    }

    public function updateEmp(Request $request, $emp)
    {
        $name = $request->input('nmEmpresa');
        DB::update('update empresas set nmEmpresa = ? where cdEmpresa = ?', [$name, $emp]);

        return redirect('/empresas')->with('msg', 'evento alterado com sucesso');
    }

    public function dashe()
    {
        $eventos = DB::table('empresas')->get();

        return view('/empresas/empresas', ['empresas' => $eventos]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required',
        ]);

        $query = $request->input('query');
        $events = DB::table('empresas')
            ->select('cdEmpresa', 'nmEmpresa')
            ->where('nmEmpresa', 'like', "%$query%")
            ->get();


        return view('/empresas/search-results', compact('events'));
    }
}
