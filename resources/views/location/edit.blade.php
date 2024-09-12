@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Edit Location</h1>
@stop

@section('content')
<style>
    .uper {
      margin-top: 40px;
    }
  </style>
  <div class="card uper">
    <div class="card-header">
      Edit Location
    </div>
    <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div><br />
      @endif
        <form method="post" action="{{ route('location.update', $location->loc_id) }}">
            @csrf
            @method('PATCH')
                {{-- <div class="form-group">
                    <label for="id">id:</label>
                    <input type="text" class="form-control" name="id" value="{{$location->loc_id}}"/>
                </div> --}}
                <div class="form-group">
                    <label for="order">Order:</label>
                    <input type="text" class="form-control" name="order" value="{{$location->loc_order}}"/>
                </div>
                <div class="form-group">
                    <label for="province">Province:</label>
                    <input type="text" class="form-control" name="province" value="{{$location->loc_province}}"/>
                </div>
                <div class="form-group">
                    <label for="title">Title :</label>
                    <input type="text" class="form-control" name="title" value="{{$location->loc_title}}"/>
                </div>
              
            <button type="submit" class="btn btn-primary">Save Location Changes</button>
        </form>
    </div>
  </div>
@stop