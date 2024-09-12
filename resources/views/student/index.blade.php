@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <h1>Students</h1>
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
    <table id="laravel_datatable" class="table table-striped">
      <thead>
          <tr>
            <th>ID </th>
            <th>First Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>ID number</th>
            <th>Cell number</th>
            <th>Action</th>
          </tr>
      </thead>
      <tbody>
          @foreach($students as $student)
          <tr>           
              <td>{{$student->stud_id}}</td>
              <td>{{$student->stud_name}}</td>
              <td>{{$student->stud_surname}}</td>
              <td>{{$student->stud_email}}</td>
              <td>{{$student->stud_identity}}</td>
              <td>{{$student->stud_phonenumber}}</td>
              <td>
                <a href="{{ route('student.edit', $student->stud_id)}}" class="btn btn-primary" style="display: inline"><i class="fa fa-edit" aria-hidden="true"></i></a>
             
                  <form action="{{ route('student.destroy', $student->stud_id)}}" method="post" style="display: inline">
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
    $('#laravel_datatable').DataTable(
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