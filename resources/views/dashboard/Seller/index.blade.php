{{-- Extends layout --}}
@extends('layout.master')

{{-- Content --}}
@section('content')
    <div class="container">
        @include('dashboard/message')
    </div>
    {{-- Dashboard 1 --}}
    <div class="card card-custom gutter-b">
        <br>
        <div class="container">
            <div class="row">
                <div class="table-responsive">
                    <div class="card-custom" style="width: 100%">
                        {!! Form::open(['id'=>'form_data','url'=>"dashboard/seller/destroy/all",'method'=>'delete']) !!}
                            {!! $dataTable->table([
                                'class'=>'table table-separate table-head-custom table-checkable'
                            ],true)!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Alert  -->
    <div id="multipleDelete" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">@lang("Delete All")</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <div class="empty_record d-none">
                        <p>@lang("please Use some records to delete")</p>
                    </div>
                    <div class="not_empty_record d-none">
                        <p>@lang("Are you sure to delete") <span class="record_count"></span> @lang("Elements")?</p>
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">@lang("Close")</button>
                    {!! Form::submit(__("Yes"),['class'=>'btn btn-danger'])!!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>



@endsection

{{-- Scripts Section --}}
@section('scripts')
{!! $dataTable->scripts() !!}

<!-- Datatables buttons -->
<script src="{{asset("plugins/datatables/checkbox.js")}}"></script>
<script>
    delete_all();
</script>
<script src="{{asset("plugins/datatables/jquery.dataTables.min.js")}}"></script>
<script src="{{asset("plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
<script src="{{asset("plugins/datatables-responsive/js/dataTables.responsive.min.js")}}"></script>
<script src="{{asset("plugins/datatables-responsive/js/responsive.bootstrap4.min.js")}}"></script>
<script src="{{asset("plugins/vendor/datatables/buttons.server-side.js")}}"></script>
<script src="{{asset("plugins/datatables-buttons/dataTables.buttons.min.js")}}"></script>
<script src="{{asset("plugins/vendor/datatables/buttons.server-side.js")}}"></script>

@endsection
@section('styles')
<link rel="stylesheet" href="{{asset("plugins/datatables-buttons/css/buttons.bootstrap4.min.css")}}">
<link rel="stylesheet" href="{{asset("plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}">
<link rel="stylesheet" href="{{asset("plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
@endsection
