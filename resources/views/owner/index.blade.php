@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Property Owners</h1>
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
    <table id="owners_datatable" class="table table-striped">
      <thead>
          <tr>
            <td>ID</td>
            <td>First Name</td>
            <td>Surname</td>
            <td>Email</td>
            <td>Address</td>
            <td>image</td>
            <td>Action</td>
          </tr>
      </thead>
      <tbody>
          @foreach($owners as $owner)
          <tr>
              <td>{{$owner->owner_id}}</td>
              <td>{{$owner->owner_name}}</td>
              <td>{{$owner->owner_surname}}</td>
              <td>{{$owner->owner_email}}</td>
              <td>{{$owner->owner_address}}</td>
              <td>{{$owner->owner_image}}</td>
              <td><a href="{{ route('owner.edit', $owner->owner_id)}}" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i></a>
                  <form action="{{ route('owner.destroy', $owner->owner_id)}}" method="post">
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
    $('#owners_datatable').DataTable(
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