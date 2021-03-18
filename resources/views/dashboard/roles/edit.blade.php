@extends('layout.master')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('edit') }} {{ trans('roles') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('dashboard.roles.update', [$role->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="title">{{ trans('title') }}</label>
                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title"
                        id="title" value="{{ old('title', $role->name) }}" required>
                    @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif

                </div>
                <div class="form-group">
                    <label class="required" for="permissions">{{ trans('permissions') }}</label>

                    <select class="form-control select2 {{ $errors->has('permissions') ? 'is-invalid' : '' }}"
                        name="permissions[]" id="permissions" multiple required>
                        @foreach ($permissions as $id => $permission)

                            <option value="{{ $id }}"
                                {{ in_array($id, old('permissions', [])) || $role->permissions->contains($id) ? 'selected' : '' }}>
                                {{ $permission }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('permissions'))
                        <span class="text-danger">{{ $errors->first('permissions') }}</span>
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
@section('scripts')
    <script src="{{ asset('js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script>
        $('#permissions').select2({

        });

    </script>
@endsection
