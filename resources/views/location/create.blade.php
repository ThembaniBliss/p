@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Add a location</h1>
@stop

@section('content')
<style>
    .uper {
      margin-top: 40px;
    }
  </style>
  <div class="card uper">
    <div class="card-header">
      Add location (Province or Area)
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
        <form method="post" action="{{ route('location.store') }}">
            @csrf
                {{-- <div class="form-group">
                    <label for="id">id:</label>
                    <input type="text" class="form-control" name="id"/>
                </div> --}}
                <div class="form-group">
                    <label for="order">Order:</label>
                    <input type="text" class="form-control" name="order"/>
                </div>
                <div class="form-group">
                    <label for="province">Province:</label>
                    <input type="text" class="form-control" name="province"/>
                </div>
                <div class="form-group">
                    <label for="title">Title :</label>
                    <input type="text" class="form-control" name="title"/>
                </div>
              
            <button type="submit" class="btn btn-primary">Add Location</button>
        </form>
    </div>
  </div>
@stop