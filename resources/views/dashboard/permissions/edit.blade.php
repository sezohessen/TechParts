@extends('layout.master')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('edit') }} {{ trans('permission') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('dashboard.permissions.update', [$permission->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="title">{{ trans('title') }}</label>
                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title"
                        id="title" value="{{ old('title', $permission->name) }}" required>
                    @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif

                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>



@endsection
