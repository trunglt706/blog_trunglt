@extends('layouts.auth.main')
@section('content')
<main class="page_main_wrapper">
    <!-- START PAGE HEADER -->
    <section class="inner-head" style="background-image: url(assets/images/faq-bg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="entry-title">HỎI ĐÁP</h1>
                    <p class="description">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem quam, adipiscing condimentum tristique vel, eleifend sed turpis. Pellentesque cursus arcu id magna euismod in elementum purus molestie.
                    </p>
                    <div class="breadcrumb">
                        <ul class="clearfix">
                            <li class="ib"><a href="{{route('home')}}">Trang chủ</a></li>
                            <li class="ib current-page">Hỏi đáp</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END OF /. PAGE HEADER -->
    @if(isset($data['hoidap']))
    <section class="faq-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="panel-group" id="accordion" role="tablist">
                        @php $i = 0; @endphp
                        @foreach($data['hoidap'] as $hoi)
                        <div class="panel">
                            <div class="panel-heading active" role="tab" id="heading-{{$i}}">
                                <h4 class="panel-title">
                                    <a @if($i > 0) class="collapsed" @endif role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{$i}}" aria-controls="collapse-{{$i}}">
                                        {{$hoi->name}}
                                </a>
                            </h4>
                        </div>
                        <div id="collapse-{{$i}}" class="panel-collapse collapse @if($i==0) in @endif" role="tabpanel" aria-labelledby="heading-{{$i}}">
                            <div class="panel-body">
                                <h4>{{$hoi->name}}</h4>
                                <p>{{$hoi->intro}}</p>
                            </div>
                        </div>
                    </div>
                    @php $i++; @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif
</main>
@endsection