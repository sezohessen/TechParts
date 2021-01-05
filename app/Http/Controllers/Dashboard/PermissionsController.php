<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPermissionRequest;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('permission-read'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::all();

        return view('dashboard.permissions.index', compact('permissions'));
    }

    public function create()
    {
        abort_if(Gate::denies('permission-create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('dashboard.permissions.create');
    }

    public function store(StorePermissionRequest $request)
    {
        $permission = Permission::create($request->all());

        return redirect()->route('dashboard.permissions.index');
    }

    public function edit(Permission $permission)
    {
        abort_if(Gate::denies('permission-update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('dashboard.permissions.edit', compact('permission'));
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update($request->all());

        return redirect()->route('dashboard.permissions.index');
    }

    public function show(Permission $permission)
    {
        abort_if(Gate::denies('permission-read'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('dashboard.permissions.show', compact('permission'));
    }

    public function destroy(Permission $permission)
    {
        abort_if(Gate::denies('permission-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permission->delete();

        return back();
    }

    public function massDestroy(MassDestroyPermissionRequest $request)
    {
        Permission::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
