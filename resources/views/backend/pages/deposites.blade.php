@extends('backend.layout')
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
          <a class="btn btn-sm btn-info" href="{{ url('deposit/create') }}">
            <i class="glyphicon glyphicon-plus"></i> New Deposit
          </a>
        </div>
        @include('backend.partials.response_message')

        <div class="card-body p-0 pb-3 text-center">
          <table class="table table-sm">
            <thead class="bg-light">
              <tr>
                <th scope="col" class="border-0">#</th>
                <th scope="col" class="border-0">Transaction ID</th>     
                <th scope="col" class="border-0">Amount</th>
                <th scope="col" class="border-0">Remarks</th>
              </tr>
            </thead>
            <tbody>
              @forelse($deposites as $deposite)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ str_pad($deposite->id, 10, '0', STR_PAD_LEFT) }}</td>
                  <td>{{ $deposite->amount }}</td>
                  <td>{{ $deposite->remarks }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="text-danger">Not found</td>
                </tr>
              @endforelse
            </tbody>
            <tfoot>
              @if($deposites->total() > 15)
                <tr>
                  <td colspan="4" align="center">
                    {{ $deposites->appends(request()->except('page'))->links() }}
                  </td>
                </tr>
              @endif
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection