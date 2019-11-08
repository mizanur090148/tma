@extends('backend.layout')
@section('styles')  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.css" />
@endsection
@section('content')
  <div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">      
      <h3 class="page-title">Deposit</h3>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="card card-small mb-4">
        <div class="card-header border-bottom">
          <h6 class="m-0">Deposit</h6>
        </div>
        <div class="card-body p-0 pb-3">
          <div class="row p-3">
          <div class="col-sm-4 offset-sm-4">
            {!! Form::open(['url' => 'deposit-post', 'method' => 'POST']) !!}
              <div class="form-group">
                <strong class="text-muted d-block mb-2">Amount</strong>
                {!! Form::text('amount', null, ['class' => 'form-control', 'placeholder' => 'Enter amount']) !!}
                @if($errors->has('amount'))
                  <span class="text-danger">{{ $errors->first('amount') }}</span>
                @endif
              </div>
              <div class="form-group">
                <strong class="text-muted d-block mb-2">Remarks</strong>              
                {!! Form::textarea('remarks', null, ['class' => 'form-control', 'rows' => 2, 'placeholder' => 'Enter remarks']) !!}              
              </div>            
              <div class="form-group">        
                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
              </div>
            {!! Form::close() !!}
          </div>
          </div>      
        </div>
      </div>
    </div>
  </div>
@endsection