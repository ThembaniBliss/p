@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Add a Property</h1>
@stop

@section('content')
<style>
    .uper {
      margin-top: 40px;
    }
  </style>
  <div class="card uper">
    <div class="card-header">
      Add Properties
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
        <form method="post" action="{{ route('property.store') }}">
            @csrf
            
                <div class="form-group">
                    <label for="owner">Owner:</label>
                    <input type="text" class="form-control" name="owner"/>
                </div>
                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" class="form-control" name="location"/>
                </div>
                <div class="form-group">
                    <label for="accommodation_type">Accommodation type :</label>
                    <input type="text" class="form-control" name="accommodation_type"/>
                </div>
                <div class="form-group">
                    <label for="rental_fee">Rental fee :</label>
                    <input type="text" class="form-control" name="rental_fee"/>
                </div>
           
                <div class="form-group">
                    <label for="rental_deposit">Rental Deposit:</label>
                    <input type="text" class="form-control" name="rental_deposit"/>
                </div>
                <div class="form-group">
                    <label for="rental_negotiable">Rent Negotiable?:</label>
                    <input type="text" class="form-control" name="rental_negotiable"/>
                </div>
                <div class="form-group">
                    <label for="rooms">Number of rooms :</label>
                    <input type="number" class="form-control" name="rooms"/>
                </div>
                <div class="form-group">
                    <label for="phone">Number of beds :</label>
                    <input type="number" class="form-control" name="beds"/>
                </div>
                <div class="form-group">
                    <label for="rental_term">Rental Term :</label>
                    <input type="number" class="form-control" name="rental_term"/>
                </div>
                <div class="form-group">
                <label for="description">Description</label>    
                <input type="textarea" class="form-control" name="description" />
            </div>
            <button type="submit" class="btn btn-primary">Add Property</button>
        </form>
  </div>
  </div>
@stop