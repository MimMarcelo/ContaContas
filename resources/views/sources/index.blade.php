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
                <td>{{$s->currency_id}}</td>
                <td>{{$s->cc}}</td>
                <td>{{$s->resume}}</td>
                <td>
                    <a href="{{route('sources.edit', $s->id)}}" 
                        class="material-symbols-outlined btn btn-warning">edit</a>
                </td>
                <td>
                    <form action="{{route('sources.destroy', $s->id)}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <input type="submit" value="delete"
                            class="material-symbols-outlined btn btn-danger">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <button type="button" title="Add new Source" id="add"
        class="fixed-bottom btn btn-primary fixed-button material-symbols-outlined"
        data-bs-toggle="modal" data-bs-target="#myModal">
        add
    </button>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Source</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form name="formCreateSource" action="{{route('sources.store')}}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="name" class="form-label">Source</label>
                  <input type="text" class="form-control" id="name" name="name" required value="Home">
                </div>
                <div class="form-group">
                  <label for="code" class="form-label">Code</label>
                  <input type="text" class="form-control" id="code" name="code" required value="HOM">
                </div>
                <div class="form-group">
                  <label for="group" class="form-label">Group</label>
                  <input type="text" class="form-control" id="group" name="group" required value="Spent">
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
                  <input type="checkbox" class="form-check-input" id="cc" name="cc" value="true" checked>
                  <label class="form-check-label" for="cc">
                      Credit Card?
                  </label>
                </div>
                <div class="form-check form-switch">
                  <input type="checkbox" class="form-check-input" id="resume" name="resume" value="true" checked>
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
@endsection