
@foreach($data as $key=>$item)

    <a href="{{route('dashboard.news.edit', ['news' => $item->id])}}" class="btn btn-sm btn-primary mb-2" style="min-width:200px">
        {{ Session::get('app_locale')=='en'? $item->title : $item->title_ar }}
    </a>
    <br>
@endforeach

