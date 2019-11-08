@extends('backend.layout')
@section('content')
  <div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
      <div class="card card-small mb-4 pt-3 text-center">
        <div class="card-header border-bottom text-center">          
          <h4 class="mb-0">{{ currentUser()->full_name}}</h4>         
        </div>
        <table class="table table-bordered">
          <tbody>
            <tr>
              <th>Name: {{ currentUser()->full_name }}</th>
              <th>Mobile no.: {{ currentUser()->mobile_no }}</th>
            </tr>
            <tr>
              <th>E-mail: {{ currentUser()->email }}</th>
              <th>Personal Code: {{ currentUser()->personal_code }}</th>
            </tr>
            <tr>
              <th colspan="2">Address: {{ currentUser()->address }}</th>              
            </tr>
          </tbody>
        </table>

        <table class="table table-bordered">
          <tbody>
            <tr>
              <th>Current Balance : {{ $current_balance }}</th>              
            </tr>
            <tr>
              <th>Total Deposit: {{ $total_deposit }} </th>              
            </tr>
            <tr>
              <th>Total Sent To Other Accounts: {{ $total_sent }}</th>              
            </tr>
          </tbody>
        </table>        
      </div>
    </div>   
  </div>
@endsection