@extends('backend.auth.auth')
@section('content')
  <!-- Small Stats Blocks -->
  <div class="row" style="padding-top: 100px">
    <div class="col-lg col-md-4 col-sm-4 mb-4">
      <div class="stats-small stats-small--1 card card-small">
        <div class="card-body p-0 d-flex">
          <div class="d-flex flex-column m-auto">
            <div class="stats-small__data text-center">              
              <h4 class="stats-small__value count my-3 text-uppercase">
                <a href="{{ url('/signup') }}">signup</a>
              </h4>
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
              <h4 class="stats-small__value count my-3 text-uppercase">
                <a href="{{ url('/login') }}">login</a>
              </h4>
            </div>           
          </div>
          <canvas height="120" class="blog-overview-stats-small-2"></canvas>
        </div>
      </div>
    </div>    
  </div>  
@endsection