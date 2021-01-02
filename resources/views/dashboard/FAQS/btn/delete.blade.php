<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-danger " data-toggle="modal" data-target="#myModal{{$id}}">
    <i class="fa fa-trash"></i>
</button>
<!-- Modal -->
<div id="myModal{{$id}}" class="modal fade" role="dialog">
<div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{__("admin.admin_table_delete")}}</h4>
    </div>
    {!! Form::open(['route'=>['faqs.destroy',$id],'method'=>'delete']) !!}
    <div class="modal-body">
        <p></p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">{{__("admin.table_record_delete_close")}}</button>
        {!! Form::submit(__("admin.table_record_delete_yes"),['class'=>'btn btn-danger'])!!}
    </div>
    </div>

</div>
</div>
