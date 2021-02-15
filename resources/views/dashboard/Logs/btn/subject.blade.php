@if($subject_type)
    <?php
        $model=$subject_type::where('id', $subject_id)->first();
    ?>
    @if($model)
        @if($subject_type=='App\Models\User')
            <a href="{{route('dashboard.users.edit', ['user' => $model->id])}}"class="btn btn-sm btn-warning ">
                <i class=" icon-nm text-primary-50 flaticon2-reply"></i>
            </a>
        @elseif($subject_type=='App\Models\Car')
            <a href="{{route('dashboard.car.edit', ['car' => $model->id])}}" class="btn btn-sm btn-warning ">
                <i class=" icon-nm text-primary-50 flaticon2-reply"></i>
            </a>
        @else
            <span class="label label-danger label-pill label-inline mr-2">@lang("Empty")</span>
        @endif
    @else
        <span class="label label-danger label-pill label-inline mr-2">@lang("deleted")</span>
    @endif
@else
    <span class="label label-danger label-pill label-inline mr-2">@lang("Unknow resource")</span>
@endif
