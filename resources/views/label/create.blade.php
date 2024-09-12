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
      Add A Label
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
        <form method="post" action="{{ route('label.store') }}">
            @csrf
            
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name"/>
                </div>
                <div class="form-group">
                    <label for="value">Value:</label>
                    <input type="text" class="form-control" name="value"/>
                </div>
                <div class="form-group">
                    <label for="icon">Icon :</label>
                    <input type="text" class="form-control" name="icon"/>

                </div>
              
             
            <button type="submit" class="btn btn-primary">Add label</button>
        </form>
    </div>
  </div>
@stop