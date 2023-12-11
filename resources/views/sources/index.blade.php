@extends('layouts.master')

@section('title', 'Sources')

@section('content')
<table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Code</th>
      <th>Group</th>
      <th>Currency</th>
      <th>CC</th>
      <th>Resume</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  @foreach ($sources as $s)
    <tr>
      <td>{{$s->id}}</td>
      <td>{{$s->name}}</td>
      <td>{{$s->code}}</td>
      <td>{{$s->group}}</td>
      <td>
        @foreach($currencies as $c)
          @if ($c->id == $s->currency_id)
              <span title="{{$c->name}}">
                {{$c->code}}
              </span>
              @break
          @endif
        @endforeach
      </td>
      <td>{{$s->cc}}</td>
      <td>{{$s->resume}}</td>
      <td>
        <button type="button" class="btn btn-info material-symbols-outlined filled"
          data-bs-toggle="modal" data-bs-target="#editSourceModal" 
          data-name="{{$s->name}}" data-code="{{$s->code}}" data-group="{{$s->group}}" data-id="{{$s->id}}"
          data-currency="{{$s->currency_id}}" data-cc="{{$s->cc}}" data-resume="{{$s->resume}}">
          edit
        </button>
      </td>
      <td>
        <button type="button" class="btn btn-danger material-symbols-outlined filled" 
          data-bs-toggle="modal" data-bs-target="#deleteSourceModal" 
          data-name="{{$s->name}}" data-id="{{$s->id}}">
          delete
        </button>
      </td>
    </tr>
  @endforeach
</table>
<button type="button" title="Add new Source" id="add"
  class="fixed-bottom btn btn-primary material-symbols-outlined filled fixed-button"
  data-bs-toggle="modal" data-bs-target="#createSourceModal">
  add
</button>
<div class="modal fade" id="createSourceModal" tabindex="-1" aria-labelledby="createSourceModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="createSourceModalLabel">Add New Source</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="formCreateSource">
          @csrf
          <div class="form-group">
            <label for="name" class="form-label">Source</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="form-group">
            <label for="code" class="form-label">Code</label>
            <input type="text" class="form-control" id="code" name="code" required>
          </div>
          <div class="form-group">
            <label for="group" class="form-label">Group</label>
            <input type="text" class="form-control" id="group" name="group" required>
          </div>
          <div class="form-group">
            <label for="currency_id" class="form-label">currency_id</label>
            <select type="text" class="form-control" id="currency_id" name="currency_id">
              @foreach ($currencies as $c)
                  <option value="{{$c->id}}" @selected($c->default)>{{$c->code}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-check form-switch">
            <input type="checkbox" class="form-check-input" id="cc" name="cc" value="true">
            <label class="form-check-label" for="cc">
                Credit Card?
            </label>
          </div>
          <div class="form-check form-switch">
            <input type="checkbox" class="form-check-input" id="resume" name="resume" value="true">
            <label class="form-check-label" for="resume">
                Resume?
            </label>
          </div>
          <input type="submit" class="btn btn-primary" value="Create">
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="deleteSourceModal" tabindex="-1" aria-labelledby="deleteSourceModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteSourceModalLabel">Confirm</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <h5></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button data-id="0" class="btn btn-danger delete-source">
          Yes
        </button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="editSourceModal" tabindex="-1" aria-labelledby="editSourceModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editSourceModalLabel">Edit Source</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="formEditSource">
          @csrf
          <input type="hidden" name="id">
          <div class="form-group">
            <label for="editName" class="form-label">Source</label>
            <input type="text" class="form-control" id="editName" name="name" required>
          </div>
          <div class="form-group">
            <label for="editCode" class="form-label">Code</label>
            <input type="text" class="form-control" id="editCode" name="code" required>
          </div>
          <div class="form-group">
            <label for="editGroup" class="form-label">Group</label>
            <input type="text" class="form-control" id="editGroup" name="group" required>
          </div>
          <div class="form-group">
            <label for="editCurrency" class="form-label">Currency</label>
            <select type="text" class="form-control" id="editCurrency" name="currency_id">
              @foreach ($currencies as $c)
                  <option value="{{$c->id}}">{{$c->code}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-check form-switch">
            <input type="checkbox" class="form-check-input" id="editCC" name="cc" value="true">
            <label class="form-check-label" for="editCC">
                Credit Card?
            </label>
          </div>
          <div class="form-check form-switch">
            <input type="checkbox" class="form-check-input" id="editResume" name="resume" value="true">
            <label class="form-check-label" for="editResume">
                Resume?
            </label>
          </div>
          <button type="submit" class="btn btn-primary edit-source">Edit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@include('sources.js')
@endsection