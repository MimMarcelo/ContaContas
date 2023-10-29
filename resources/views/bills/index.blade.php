@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <div class="row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card text-bg-warning" style="width: 18rem;">
                <div class="card-header">
                    99Pop
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        Credit R$ {{$total["credit"]}}
                    </li>
                    <li class="list-group-item">
                        Debit R$ {{$total["debit"]}}
                    </li>
                    <li class="list-group-item">
                        Total R$ {{$total["credit"] - $total["debit"]}}
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Kind</th>
                <th>Name</th>
                <th>Value</th>
                <th>Entry</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th colspan="3">Total</th>
                <th colspan="4">{{$total["debit"]}}</th>
            </tr>
        </tfoot>
        @foreach ($bills as $b)
            <tr>
                <td>{{$b->id}}</td>
                <td>{{$b->kind}}</td>
                <td>
                    <a href="{{route('bills.show', $b)}}">{{$b->name}}</a>
                </td>
                <td>{{sprintf("R$ %0.2f", $b->value)}}</td>
                <td>{{date_format(new DateTime($b->entry), "d/m/y")}}</td>
                <td>
                    <a href="{{route('bills.edit', $b)}}" 
                        class="material-symbols-outlined btn btn-warning">edit</a>
                </td>
                <td>
                    <form action="{{route('bills.destroy', $b->id)}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <input type="submit" value="delete"
                            class="material-symbols-outlined btn btn-danger">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection