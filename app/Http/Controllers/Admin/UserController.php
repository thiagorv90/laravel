<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }


    public function index()
    {

        return view('admin.users.index');
    }

    public function delete($id)
    {
        User::find($id)->delete();
        // $deleted = DB::delete('delete from telefone_contatos where cdTelefone = ?', [$id]);
        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $users = DB::table('users')->get();
        return view('users.usuarios', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = DB::table('users')->where('id', '=', $id)->get();
        $sele = DB::table('users')->get();

        return view('users.edit', ['users' => $users, 'sele' => $sele]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $name = $request->input('name');
        $email = $request->input('email');
        $adm = $request->input('statusadm');


        DB::update('update users set name = ?, email = ?, statusadm = ?
        where id = ?', [$name, $email, $adm, $id]);


        return redirect('/usuarios')->with('msg', 'evento alterado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required',
        ]);

        $query = $request->input('query');

        $users = DB::table('users')->where('name', 'like', "%$query%")->orWhere('email', 'like', "%$query%")->paginate(6);

        return view('users/search-results', compact('users'));

    }

    static function userFirstAndLastName(): string
    {
        $name = auth()->user()->name;

        $namesArray = explode(' ', $name);
        $firstName = reset($namesArray);
        $lastName = end($namesArray);

        return $firstName . " " . $lastName;
    }
}
