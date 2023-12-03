@extends('layouts.master')

@section('title', 'Home')

@section('content')
<!-- Button trigger modal -->
<button type="button" id="btn-open-modal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#currencyModal">
  Add Currency
</button>
<table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Code</th>
      <th>Default</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  @foreach ($currencies as $c)
    <tr>
      <td >{{$c->id}}</td>
      <td>
        <a href="{{route('currencies.show', $c)}}">{{$c->name}}</a>
      </td>
      <td>{{$c->code}}</td>
      <td>{{$c->default}}</td>
      <td>
        <a href="{{route('currencies.edit', $c)}}" class="material-icons btn btn-warning">edit</a>
      </td>
      <td>
        <button type="button" class="btn btn-danger material-icons" data-bs-toggle="modal" data-bs-target="#deleteCurrencyModal" data-currency="{{$c->name}}" data-id="{{$c->id}}" class="material-icons btn btn-danger">delete</button>
      </td>
    </tr>
  @endforeach
</table>
<!-- Modal Add Currency -->
<div class="modal fade" id="currencyModal" tabindex="-1" aria-labelledby="currencyModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="currencyModalLabel">Add Currency</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="formCurrency">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Currency</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="code" class="form-label">Code</label>
            <input type="text" class="form-control" id="code" name="code" required>
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="default" name="default" value="true">
            <label class="form-check-label" for="default" title="If this is your only currency, it will be set as default and it will be used by the system as default currency">
                Default Currency
                <span class="text-danger material-icons">help_center</span>
            </label>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteCurrencyModal" tabindex="-1" aria-labelledby="deleteCurrencyModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <h5></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button data-id="0" class="btn btn-danger delete-currency">
          Yes
        </button>
      </div>
    </div>
  </div>
</div>
@include('currencies.js');
@endsection