{{-- Extends layout --}}
@extends('layout.master')

{{-- Content --}}
@section('content')
    <div class="container">
        @include('dashboard/message')
    </div>

    {{-- Dashboard 1 --}}
    <div class="card card-custom gutter-b">
        <div class="card-header flex-wrap py-3" style="min-height: 50px">
            <a href="{{route("dashboard.car.create")}}" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/Flatten.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="20px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="20" />
                            <circle fill="#000000" cx="9" cy="15" r="6" />
                            <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
                @lang("New Record")
            </a>
        </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="table-responsive">
                    <div class="card-custom" style="width: 100%">
                        {!! Form::open(['id'=>'form_data','url'=>"dashboard/car/destroy/all",'method'=>'delete']) !!}
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
