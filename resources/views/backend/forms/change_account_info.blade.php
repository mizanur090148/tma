@extends('backend.layout')
@section('styles')  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.css" />
@endsection
@section('content')
  <div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">      
      <h3 class="page-title">Profile</h3>
    </div>
  </div>
  @include('backend.partials.response_message')
  <div class="row">   
    <div class="col-lg-4">
      <div class="card card-small mb-4">
        <div class="card-header border-bottom">
          <h6 class="m-0">Change Password</h6>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item p-3">
            <div class="row">              
              <div class="col">
                {!! Form::open(['url' => 'change-password-post', 'method' => 'POST']) !!}
                  <div class="form-row">
                    <div class="form-group col-md-12">                     
                      <label for="currentPassword">Current Password</label>
                      {!! Form::password('current_password', ['class' => 'form-control', 'placeholder' => 'Enter current password']) !!}
                      @if($errors->has('current_password'))
                        <span class="text-danger">{{ $errors->first('current_password') }}</span>
                      @endif
                    </div>
                  </div>                 
                  <div class="form-row">
                    <div class="form-group col-md-12">
                      <label for="feFirstName">New Password</label>
                      {!! Form::password('new_password', ['class' => 'form-control', 'placeholder' => 'Enter new password']) !!}
                      @if($errors->has('new_password'))
                        <span class="text-danger">{{ $errors->first('new_password') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-12">
                      <label for="feFirstName">Confirm Password</label>
                      {!! Form::password('confirm_password', ['class' => 'form-control', 'placeholder' => 'Enter cofirm password']) !!}
                      @if($errors->has('confirm_password'))
                        <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                      @endif
                    </div>                    
                  </div>
                  <button type="submit" class="btn btn-accent">Update Account</button>
                {!! Form::close() !!}
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="card card-small mb-4">
        <div class="card-header border-bottom">
          <h6 class="m-0">Account Details</h6>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item p-3">
            <div class="row">
              <div class="col">
                {!! Form::model($accountInfo, ['url' => 'change-account-info-post', 'method' => 'POST']) !!}
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="feFirstName">First Name</label>
                      {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                      @if($errors->has('first_name'))
                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                      @endif
                    </div>
                    <div class="form-group col-md-6">
                      <label for="feLastName">Last Name</label>
                      {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                      @if($errors->has('last_name'))
                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="feEmailAddress">Email</label>
                      {!! Form::email('email', null, ['class' => 'form-control']) !!}
                      @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                      @endif
                    </div>
                    <div class="form-group col-md-6">
                      <label for="fePassword">Personal Code</label>
                      {!! Form::text('personal_code', null, ['class' => 'form-control']) !!}                    
                      @if($errors->has('personal_code'))
                        <span class="text-danger">{{ $errors->first('personal_code') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="feEmailAddress">Mobile No.</label>
                      {!! Form::text('mobile_no', null, ['class' => 'form-control']) !!}
                      @if($errors->has('mobile_no'))
                        <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                      @endif
                    </div>
                    <div class="form-group col-md-6">
                      <label for="feInputAddress">Address</label>
                      {!! Form::textarea('address', null, ['class' => 'form-control', 'rows' => 2]) !!}
                      @if($errors->has('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                      @endif
                    </div>
                  </div>
                  <button type="submit" class="btn btn-accent">Update Account</button>
                {!! Form::close() !!}
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
@endsection
