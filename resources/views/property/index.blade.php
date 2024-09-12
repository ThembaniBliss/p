@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>All Properties</h1>
@stop

@section('content')
<style>
    .uper {
      margin-top: 40px;
    }
  </style>
  <div class="uper">
    @if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}  
      </div><br />
    @endif
    <table id="properties_data" class="table table-striped">
      <thead>
          <tr>
            <td>Owner</td>
            <td>Location</td>
            <td>Approval</td>
            <td>Description</td>
            <td>Fee</td>
            <td>Deposit</td>
            <td>Negotiable</td>
            <td>Rooms</td>
            <td>Beds</td>
            <td>Term</td>
            <td>Type</td>            
            <td>Action</td>
          </tr>
      </thead>
      <tbody>
          @foreach($properties as $property)
         
          <tr>
              <td>{{$property->owner->owner_name ?? ""}}</td>
              <td>{{$property->location->loc_province}}</td>
              <td>
                <input data-id="{{$property->prop_id}}" class="toggle-class" type="checkbox" data-onstyle="success"
                 data-offstyle="danger" data-toggle="toggle" data-on="YES" data-off="NO" 
                 {{ $property->prop_approved ? 'checked' : '' }}>
              </td>
              <td>{{$property->prop_description}}</td>
              <td>{{$property->prop_rental_fee}}</td>
              <td>{{$property->prop_deposit}}</td>
              <td>{{$property->prop_rental_negotiable}}</td>
              <td>{{$property->prop_rooms}}</td>
              <td>{{$property->prop_beds}}</td>
              <td>{{config('rentalterm.'.$property->prop_rental_term)}}</td>
              <td>{{config('accommodation.'.$property->prop_accomodation_type)}}</td>
              <td>
                <a href="{{ route('property.show', $property->prop_id)}}" class="text-success text-small"><i class="fa fa-eye" aria-hidden="true"></i></a>
                {{-- <a href="{{ route('property.edit', $property->prop_id)}}" class="text-primary text-small"><i class="fa fa-edit" aria-hidden="true"></i></a>
                  <form action="{{ route('property.destroy', $property->prop_id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="text-danger text-small" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                  </form> --}}
              </td>
          </tr>
          @endforeach
      </tbody>
    </table>
  <div>
@stop

@section('js')
<script>
  $(function() {
    $('.toggle-class').change(function() {
        var prop_approved = $(this).prop('checked') == true ? 1 : 0; 
        var prop_id = $(this).data('id'); 
      
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/approveProperty',
            data: {'prop_approved': prop_approved, 'prop_id': prop_id},
            success: function(data){
              console.log(data.success)
            }
        });

    })
  })
</script>
<script>
  $(document).ready( function () {
    $('#properties_data').DataTable(
      {
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
        "dom": 'Bfrtip',
        "buttons": [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ]
      });
   });
</script>
@stop