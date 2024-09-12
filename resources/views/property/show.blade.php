@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1></h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Property Detail</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('property.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Decription:</strong>
            {{ $property->prop_description }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Address:</strong>
            {{ $property->prop_address }}
        </div>
    </div>
    <hr>
    @foreach($property->gallery as $gallery)
        @foreach($gallery->image as $pix)
          <div class="card">
              <img class="image-fluid" src="https://reslocate.send-it.me/repo/{{$pix->img_filename}}" alt="">
              <p>{{$pix->img_id}}</p>
        </div>
        @endforeach
        <hr>
    @endforeach
</div>
@stop