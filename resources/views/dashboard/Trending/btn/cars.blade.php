@foreach($data as $key=>$item)

    <a href="{{route('dashboard.car.edit', ['car' => $item->id])}}" class="btn btn-sm btn-primary mb-2" style="min-width:200px">
        {{($item->maker) ? $item->maker->name."-" : "" }} {{($item->model) ? $item->model->name."-" :  ""}}  {{$item->year->year}}
    </a>
    <br>
@endforeach

