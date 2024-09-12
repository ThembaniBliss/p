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
  <div class="card uper">
    <div class="card-header">
      Add Students
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
        <form method="post" action="{{ route('student.update', $student->stud_id) }}">
            @csrf
            @method('PATCH')
                 <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" name="firstname" value="{{$student->stud_name}}"/>
                </div>
                <div class="form-group">
                    <label for="surname">Surname:</label>
                    <input type="text" class="form-control" name="surname" value="{{$student->stud_surname}}"/>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" value="{{$student->stud_email}}"/>
                </div>
                <div class="form-group">
                    <label for="idnum">Identity number :</label>
                    <input type="text" class="form-control" name="idnumber" value="{{$student->stud_identity}}"/>
                </div>
                <div class="form-group">
                    <label for="phone">Phone number :</label>
                    <input type="text" class="form-control" name="phone" value="{{$student->stud_phone}}"/>
                </div>
             <button type="submit" class="btn btn-primary">Update Student</button>
        </form>
    </div>
  </div>
@stop