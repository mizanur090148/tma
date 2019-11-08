@extends('backend.auth.auth')
@section('content')
<div class="row">
  <div class="col-lg-6 offset-sm-3 mb-4 p-5">
    <div class="card card-small mb-4">
      <div class="card-header border-bottom">
        <h6 class="m-0">Customer Signup Form</h6>        
      </div>      
      <div class="row p-3">
        <div class="col-sm-12 col-md-8">
          {!! Form::open(['url' => 'signup-post', 'method' => 'POST']) !!}
            <div class="form-group">
              <strong class="text-muted d-block mb-2">First Name</strong>
              {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Enter first name']) !!}
              @if($errors->has('first_name'))
                <span class="text-danger">{{ $errors->first('first_name') }}</span>
              @endif
            </div>
            <div class="form-group">
              <strong class="text-muted d-block mb-2">Last Name</strong>
              {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Enter last name']) !!}
              @if($errors->has('last_name'))
                <span class="text-danger">{{ $errors->first('last_name') }}</span>
              @endif
            </div>
            <div class="form-group">
              <strong class="text-muted d-block mb-2">E-mail</strong>              
              {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter email']) !!}
              @if($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
              @endif
            </div>
            <div class="form-group">
              <strong class="text-muted d-block mb-2">Personal Code</strong>
              {!! Form::text('personal_code', null, ['class' => 'form-control', 'placeholder' => 'Enter personal code']) !!}
              @if($errors->has('personal_code'))
                <span class="text-danger">{{ $errors->first('personal_code') }}</span>
              @endif
            </div>
            <div class="form-group">
              <strong class="text-muted d-block mb-2">Mobile No.</strong>
              {!! Form::text('mobile_no', null, ['class' => 'form-control', 'placeholder' => 'Enter mobile no']) !!}
              @if($errors->has('mobile_no'))
                <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
              @endif
            </div>
            <div class="form-group">
              <strong class="text-muted d-block mb-2">Address</strong>             
              {!! Form::textarea('address', null, ['class' => 'form-control', 'rows' => 2, 'placeholder' => 'Enter address']) !!}
              @if($errors->has('address'))
                <span class="text-danger">{{ $errors->first('address') }}</span>
              @endif
            </div>            
            <div class="form-group">
              <strong class="text-muted d-block mb-2">Password</strong>             
              {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter password']) !!}
              @if($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
              @endif
            </div>
            <div class="form-group">
              <strong class="text-muted d-block mb-2">Confirm Password</strong>          
              {!! Form::password('confirm_password', ['class' => 'form-control', 'placeholder' => 'Enter confirm password']) !!}
              @if($errors->has('confirm_password'))
                <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
              @endif
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
@endsection