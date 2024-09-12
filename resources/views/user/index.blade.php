@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
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
    <table class="table table-striped">
      <thead>
          <tr>
            <td>ID</td>
            <td>First Name</td>
            <td>Surname</td>
            <td>ID number</td>
            <td>Cell number</td>
            <td colspan="2">Action</td>
          </tr>
      </thead>
      <tbody>
          @foreach($students as $student)
          <tr>
              <td>{{$student->id}}</td>
              <td>{{$student->firstname}}</td>
              <td>{{$student->surname}}</td>
              <td>{{$student->idnumber}}</td>
              <td>{{$student->phonenumber}}</td>
              <td><a href="{{ route('student.edit', $student->id)}}" class="btn btn-primary">Edit</a></td>
              <td>
                  <form action="{{ route('student.destroy', $student->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                  </form>
              </td>
          </tr>
          @endforeach
      </tbody>
    </table>
  <div>
@stop