<div class="row">
    @if($active==1)
        <div class="col-3">
            <span class="switch switch-success">
            <label>
                <input type="checkbox"
                id="{{$id}}" {{($active==1) ? 'checked' : ''}}
                onclick="changeUserStatus(event.target, {{ $id }});"/>
            <span></span>
            </label>
            </span>
        </div>
    @else
        <div class="col-3">
            <span class="switch switch-danger">
            <label>
                <input type="checkbox"
                id="{{$id}}" {{($active==1) ? 'checked' : ''}}
                onclick="changeUserStatus(event.target, {{ $id }});"/>
            <span></span>
            </label>
            </span>
        </div>
    @endif
</div>
<script>
function changeUserStatus(_this, id) {
    var status = $(_this).prop('checked') == true ? 1 : 0;
    var id =id;
    $.ajax({
        url:"{{ route('dashboard.part.Activity',"${id}") }}",
        type: 'post',
        data: {
            _token: '{{csrf_token()}}',
            id: id,
            status: status
        },
        success: function (result) {
            $('#'+id).closest('span').toggleClass("switch-success switch-danger");
        },
        error: function (data, textStatus, errorThrown) {
            //console.log(data);
        },
    });
}
</script>
