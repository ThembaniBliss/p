@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Edit a Property</h1>
@stop

@section('content')
<style>
    .uper {
      margin-top: 40px;
    }
  </style>
  <div class="card uper">
    <div class="card-header">
      Edit Property
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
        <form method="post" action="{{ route('property.update', $property->prop_id) }}">
            @csrf
            @method('patch')
             
                <div class="form-group">
                    <label for="owner">Owner:</label>
                    <input type="text" class="form-control" name="owner" value="{{$property->owner->owner_name}}" />
                </div>
                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" class="form-control" name="location" value="{{$property->location->loc_province}}" />
                </div>
                <div class="form-group">
                    <label for="accommodation_type">Accommodation type :</label>
                    <input type="text" class="form-control" name="accommodation_type" value="{{$property->prop_accommodation_type}}" />
                </div>
                <div class="form-group">
                    <label for="rental_fee">Rental fee :</label>
                    <input type="text" class="form-control" name="rental_fee" value="{{$property->prop_rental_fee}}" />
                </div>
             
                <div class="form-group">
                    <label for="rental_deposit">Rental Deposit:</label>
                    <input type="text" class="form-control" name="rental_deposit" value="{{$property->prop_deposit}}" />
                </div>
                <div class="form-group">
                    <label for="rental_negotiable">Rent Negotiable?:</label>
                    <input type="text" class="form-control" name="rental_negotiable" value="{{$property->prop_rental_negotiable}}" />
                </div>
                <div class="form-group">
                    <label for="rooms">Number of rooms :</label>
                    <input type="number" class="form-control" name="rooms" value="{{$property->prop_rooms}}" />
                </div>
                <div class="form-group">
                    <label for="phone">Number of beds :</label>
                    <input type="number" class="form-control" name="beds" value="{{$property->prop_beds}}" />
                </div>
                <div class="form-group">
                    <label for="rental_term">Rental term :</label>
                    <input type="number" class="form-control" name="rental_term" value="{{$property->prop_rental_term}}" />
                </div>
             
                <label for="description">Description</label>    
                <input type="textarea" class="form-control" name="description" value="{{$property->prop_description}}"  />
            </div>
            <button type="submit" class="btn btn-primary">Save Property</button>
        </form>
  </div>
  </div>
@stop