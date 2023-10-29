@extends('layouts.master')

@section('title', 'Sources')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Kind</th>
                <th>Acronym</th>
                <th>Name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        @foreach ($sources as $b)
            <tr>
                <td>{{$b->id}}</td>
                <td>{{$b->kind}}</td>
                <td>
                    <a href="{{route('sources.show', $b)}}">{{$b->name}}</a>
                </td>
                <td>{{sprintf("R$ %0.2f", $b->value)}}</td>
                <td>{{date_format(new DateTime($b->entry), "d/m/y")}}</td>
                <td>
                    <a href="{{route('sources.edit', $b)}}" 
                        class="material-symbols-outlined btn btn-warning">edit</a>
                </td>
                <td>
                    <form action="{{route('sources.destroy', $b->id)}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <input type="submit" value="delete"
                            class="material-symbols-outlined btn btn-danger">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <button type="button" title="Add new Source"
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
                <form action="{{ route('sources.store') }}"
                    method="post" class="container">
                    @csrf
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Source:</label>
                        <input type="text" class="form-control form-focus" id="recipient-name" name="name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary">Save</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
    </div>
@endsection