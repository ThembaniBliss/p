@extends('adminlte::page')

@section('title', 'Gallery')

@section('content_header')
    <h1>Images for this Property</h1>
@stop

@section('content')
    <p>
        <div class="container">
            <div class="row">
                @if(isset($gallery))
                    @if(count($gallery)>0)
                        @foreach($gallery as $image)
                            <div class="col-sm-3" style="height: 200px">
                                <a class="image-popup-no-margins" href="">
                                    <img src="{{url('public/uploads')}}/{{$image->img_filename}}" class="img img-thumbnail" alt="">
                                </a>
                                <br>                              
                            </div>
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </p>
@stop