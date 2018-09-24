<div class="tabs-wrapper">
    <ul class="nav nav-tabs" role="tablist">
        @if(isset($data['list_view']))
            <li role="presentation" class="active"><a href="#baiviet_view" aria-controls="baiviet_view" role="tab" data-toggle="tab">Xem nhiều nhất</a></li>
        @endif
        @if(isset($data['list_like']))
            <li role="presentation"><a href="#baiviet_like" aria-controls="baiviet_like" role="tab" data-toggle="tab">Thích nhiều nhất</a></li>
        @endif
    </ul>
    <!-- Tab panels one -->
    <div class="tab-content">
        @if(isset($data['list_view']))
            @php $view = 1; @endphp
            <div role="tabpanel" class="tab-pane fade in active" id="baiviet_view">
                <div class="most-viewed">
                    <ul id="most-today" class="content tabs-content">
                        @foreach($data['list_view'] as $lv)
                            <li><span class="count">0{{$view}}</span><span class="text"><a href="{{route('detail.baiviet', ['slug' => $lv->slug])}}">{{$lv->name}}</a></span></li>
                            @php $view++; @endphp
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    <!-- Tab panels two -->
        @if(isset($data['list_like']))
            @php $view = 1; @endphp
            <div role="tabpanel" class="tab-pane fade" id="baiviet_like">
                <div class="popular-news">
                    @foreach($data['list_like'] as $ll)
                        <div class="p-post">
                            <h4><a href="{{route('detail.baiviet', ['slug' => $ll->slug])}}">{{$ll->name}}</a></h4>
                            <ul class="authar-info">
                                <li><i class="ti-timer"></i> {{date('d/m/Y', strtotime($ll->created_at))}}</li>
                                <li><i class="ti-thumb-up"></i>{{$ll->like}} likes</a></li>
                            </ul>
                            <div class="reatting-2">
                                @for($r = 0; $r < $ll->rating; $r++)
                                    <i class="fa fa-star"></i>
                                @endfor
                            </div>
                        </div>
                        @php $view++; @endphp
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>