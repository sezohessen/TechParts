@extends('layout.master')
@section('content')
    @can('permission_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('dashboard.permissions.create') }}">
                    {{ trans('add') }} {{ trans('cruds.permission.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('permission list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Permission">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('id') }}
                            </th>
                            <th>
                                {{ trans('title') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $key => $permission)
                            <tr data-entry-id="{{ $permission->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $permission->id ?? '' }}
                                </td>
                                <td>
                                    {{ $permission->name ?? '' }}
                                </td>
                                <td>
                                    @can('permission-read')
                                        <a class="btn btn-xs btn-primary"
                                            href="{{ route('dashboard.permissions.show', $permission->id) }}">
                                            {{ trans('view') }}
                                        </a>
                                    @endcan

                                    @can('permission-update')
                                        <a class="btn btn-xs btn-info"
                                            href="{{ route('dashboard.permissions.edit', $permission->id) }}">
                                            {{ trans('edit') }}
                                        </a>
                                    @endcan

                                    @can('permission-delete')
                                        <form action="{{ route('dashboard.permissions.destroy', $permission->id) }}"
                                            method="POST" onsubmit="return confirm('{{ trans('areYouSure') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('delete') }}">
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('permission_delete')
                let deleteButtonTrans = '{{ trans('
                global.datatables.delete ') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('dashboard.permissions.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('
                                global.datatables.zero_selected ') }}')

                            return
                        }

                        if (confirm('{{ trans('
                                global.areYouSure ') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            let table = $('.datatable-Permission:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
