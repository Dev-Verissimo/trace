<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return response()->view('admin.roles.index', compact('roles'));
    }


    public function create()
    {
        return view('admin.roles.create');
    }


    public function store(Request $request)
    {
        $role = Role::create($request->all());

        $mensagem = "Função {$role->name} criada com sucesso";
        $tipo = 'success';

        return redirect()->route('admin.roles.index')->with(compact('mensagem', 'tipo'));
    }


    public function show($id)
    {
        $role = Role::with(['permissions' => function ($q) {
            return $q->orderBy('orderShow', 'ASC');
        }])->where('id', '=', $id)->first();

        return view('admin.roles.show', compact('role'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::with(['permissions' => function ($q) {
            return $q->orderBy('orderShow', 'ASC');
        }])->where('id', '=', $id)->first();

        $allPermissions = Permission::orderBy('orderShow', 'ASC')->get();

        return response()->view('admin.roles.edit', compact('role', 'allPermissions'));
    }


    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $rP = RolePermission::where('role_id', '=', $id)->delete();
            foreach ($request->except('_token', '_method') as $r) {
                $rolePermission = new  RolePermission();
                $rolePermission->role_id = $id;
                $rolePermission->permission_id = $r;
                $rolePermission->save();
            }
        });
        $mensagem = 'Permissões atualizadas';
        $tipo = 'success';
        return redirect()->route('admin.roles.edit', $id)->with(compact('mensagem', 'tipo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
