@extends('backend.layout')
@section('content')
  <!-- Small Stats Blocks -->
  <div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
      <h3 class="page-title">Dashboard</h3>
    </div>
  </div>
  @include('backend.partials.response_message')
  <div class="row">    
    <div class="col-lg col-md-6 col-sm-6 mb-4">
      <div class="stats-small stats-small--1 card card-small">
        <div class="card-body p-0 d-flex">
          <div class="d-flex flex-column m-auto">
            <div class="stats-small__data text-center">
              <span class="stats-small__label text-uppercase">Current Balance</span>
              {{-- <h6 class="stats-small__value count my-3">{{ $current_balance }}</h6> --}}
            </div>           
          </div>
          <canvas height="120" class="blog-overview-stats-small-1"></canvas>
        </div>
      </div>
    </div>
    <div class="col-lg col-md-6 col-sm-6 mb-4">
      <div class="stats-small stats-small--1 card card-small">
        <div class="card-body p-0 d-flex">
          <div class="d-flex flex-column m-auto">
            <div class="stats-small__data text-center">
              <span class="stats-small__label text-uppercase">Total Deposit</span>
              {{-- <h6 class="stats-small__value count my-3">{{ $total_deposit }}</h6> --}}
            </div>           
          </div>
          <canvas height="120" class="blog-overview-stats-small-2"></canvas>
        </div>
      </div>
    </div>
    <div class="col-lg col-md-4 col-sm-6 mb-4">
      <div class="stats-small stats-small--1 card card-small">
        <div class="card-body p-0 d-flex">
          <div class="d-flex flex-column m-auto">
            <div class="stats-small__data text-center">
              <span class="stats-small__label text-uppercase">Total Sent</span>
             {{--  <h6 class="stats-small__value count my-3">{{ $total_sent }}</h6> --}}
            </div>            
          </div>
          <canvas height="120" class="blog-overview-stats-small-3"></canvas>
        </div>
      </div>
    </div>   
  </div>  
@endsection