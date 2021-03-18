@extends('layout.master')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('show') }} {{ trans('title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('dashboard.roles.index') }}">
                        {{ __('back to list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('id') }}
                            </th>
                            <td>
                                {{ $role->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('title') }}
                            </th>
                            <td>
                                {{ $role->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('permissions') }}
                            </th>
                            <td>
                                @foreach ($role->permissions as $key => $permissions)
                                    <span class="btn btn-info btn-sm">{{ $permissions->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('dashboard.roles.index') }}">
                        {{ __('back to list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
