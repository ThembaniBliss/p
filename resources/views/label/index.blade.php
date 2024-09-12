@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>All Labels</h1>
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
    <table id="labels_datatable" class="table table-striped">
      <thead>
          <tr>
            <td>Name</td>
            <td>Value</td>
            <td>Icon</td>
         
            <td>Action</td>
          </tr>
      </thead>
      <tbody>
          @foreach($labels as $label)
          <tr>
              <td>{{$label->label_name}}</td>
              <td>{{$label->label_value}}</td>
              <td><i class="{{$label->label_icon}}" aria-hidden="true"></i></td>
              
              <td><a href="{{ route('label.edit', $label->label_id)}}" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i></a>
                  <form action="{{ route('label.destroy', $label->label_id)}}" method="post">
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
    $('#labels_datatable').DataTable(
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