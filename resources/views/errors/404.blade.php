@extends('layouts.error.main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="error-template">
                    <h1>
                        Oops!</h1>
                    <h2>
                        404 Not Found</h2>
                    <div class="error-details">
                        Sorry, Requested page not found!
                    </div>
                    <div class="error-actions">
                        <a href="{{route('home')}}" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                            Home page </a><a href="{{route('contact')}}" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-envelope"></span> Contact Support </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection