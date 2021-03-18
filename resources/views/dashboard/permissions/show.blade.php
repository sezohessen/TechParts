@extends('layout.master')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('show') }} {{ trans('title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('dashboard.permissions.index') }}">
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
                                {{ $permission->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('title') }}
                            </th>
                            <td>
                                {{ $permission->name }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('dashboard.permissions.index') }}">
                        {{ __('back to list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
