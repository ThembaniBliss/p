@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>All Locations</h1>
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
    <table id="locations_datatable" class="table table-striped">
      <thead>
          <tr>
            {{-- <td>ID</td> --}}
            <td>Order</td>
            <td>Province</td>
            <td>Title</td>
         
            <td>Action</td>
          </tr>
      </thead>
      <tbody>
          @foreach($locations as $location)
          <tr>
              {{-- <td>{{$location->loc_id}}</td> --}}
              <td>{{$location->loc_order}}</td>
              <td>{{$location->loc_province}}</td>
              <td>{{$location->loc_title}}</td>
              
              <td><a href="{{ route('location.edit', $location->loc_id)}}" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i></a> 
               
                  <form action="{{ route('location.destroy', $location->loc_id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                  </form>
              </td>
          </tr>
          @endforeach
      </tbody>
    </table>
  <div>
@stop
 
@section('js')
<script>
  $(document).ready( function () {
    $('#locations_datatable').DataTable(
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