@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#currencyModal">
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
                <td>{{$c->id}}</td>
                <td>
                    <a href="{{route('currencies.show', $c)}}">{{$c->name}}</a>
                </td>
                <td>{{$c->code}}</td>
                <td>{{$c->default}}</td>
                <td>
                    <a href="{{route('currencies.edit', $c)}}" 
                        class="material-symbols-outlined btn btn-warning">edit</a>
                </td>
                <td>
                    <form action="{{route('currencies.destroy', $c->id)}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <input type="submit" value="delete"
                            class="material-symbols-outlined btn btn-danger">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    
    
    <!-- Modal -->
    <div class="modal fade" id="currencyModal" tabindex="-1" aria-labelledby="currencyModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="currencyModalLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
            <div class="modal-body">
                <form name="formCurrency">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Currency</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="code" class="form-label">Code</label>
                        <input type="text" class="form-control" id="code" name="code">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="default" name="default">
                        <label class="form-check-label" for="default">Default Currency</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    @include('currencies.form');
@endsection