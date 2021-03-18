@if ($causer_type)
    <?php $model = $causer_type::where('id', $causer_id)->first(); ?>
    @if ($model)
        @if ($causer_type == 'App\Models\User')
            <a href="{{ route('dashboard.users.edit', ['user' => $model->id]) }}" class="btn btn-sm btn-primary ">
                <i class=" icon-nm text-primary-50 flaticon2-reply"></i>
            </a>
        @elseif($causer_type=='App\Models\Car')
            <a href="{{ route('dashboard.car.edit', ['car' => $model->id]) }}" class="btn btn-sm btn-primary">
                <i class=" icon-nm text-primary-50 flaticon2-reply"></i>
            </a>
        @else
            <span class="label label-danger label-pill label-inline mr-2">@lang("Empty")</span>
        @endif
    @else
        <span class="label label-danger label-pill label-inline mr-2">@lang("deleted")</span>
    @endif
@else
    <span class="label label-danger label-pill label-inline mr-2">@lang("Unknown resource")</span>
@endif
