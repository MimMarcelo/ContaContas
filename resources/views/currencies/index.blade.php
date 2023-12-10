@extends('layouts.master')

@section('title', 'Currencies')

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
        <button type="button" class="btn btn-info material-symbols-outlined filled"
          data-bs-toggle="modal" data-bs-target="#editCurrencyModal" 
          data-name="{{$c->name}}" data-code="{{$c->code}}" data-default="{{$c->default}}" data-id="{{$c->id}}">
          edit
        </button>
      </td>
      <td>
        <button type="button" class="btn btn-danger material-symbols-outlined filled" 
          data-bs-toggle="modal" data-bs-target="#deleteCurrencyModal" 
          data-currency="{{$c->name}}" data-id="{{$c->id}}">
          delete
        </button>
      </td>
    </tr>
  @endforeach
</table>
<div class="modal fade" id="editCurrencyModal" tabindex="-1" aria-labelledby="editCurrencyModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editCurrencyModalLabel">Edit Currency</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="formEditCurrency">
          @csrf
          <input type="hidden" name="id">
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
                <span class="text-danger material-symbols-outlined filled">help_center</span>
            </label>
          </div>
          <button type="submit" class="btn btn-primary edit-currency">Edit</button>
        </form>
      </div>
    </div>
  </div>
</div>
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
                <span class="text-danger material-symbols-outlined filled">help_center</span>
            </label>
          </div>
          <button type="submit" class="btn btn-primary">Create</button>
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
@include('currencies.js')
@endsection