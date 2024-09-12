@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Orders</h1>
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
    <table id="orders_datatable" class="table table-striped">
      <thead>
          <tr>
            <th>ID</th>
            <th>Property Name</th>
            <th>Amount</th>
            <th>Method</th>
            <th>Reference</th>
            <th>Order Status</th>
            <th>Created at </th>
            <th>Updated at</th>
            
          </tr>
      </thead>
      <tbody>
          @foreach($orders as $order)
          <tr>
              <td>{{$order->order_id}}</td>
              <td>{{$order->prop_name}}</td>
              <td>{{$order->order_amount}}</td>
              <td>{{$order->order_payment_method}}</td>
              <td>{{$order->order_reference}}</td>
              {{-- <td>{{$order->order_status}}</td> --}}
              <td>
                <input data-id="{{$order->id}}" class="toggle-class" type="checkbox" data-onstyle="success"
                 data-offstyle="danger" data-toggle="toggle" data-on="DONE" data-off="INCOMPLETE" 
                 {{ $order->order_status ? 'checked' : '' }}>
              </td>
              <td>{{$order->order_created_at}}</td>
              <td>{{$order->order_updated_at}}</td>
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
        var order_status = $(this).prop('checked') == true ? 1 : 0; 
        var order_id = $(this).data('id'); 
      
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/approveOrder',
            data: {'order_status': order_status, 'order_id': order_id},
            success: function(data){
              console.log(data.success)
            }
        });

    })
  })
</script>
<script>
  $(document).ready( function () {
    $('#orders_datatable').DataTable(
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