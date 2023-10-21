@extends('layouts.master')

@section('title', 'Home')

@section('content')
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
                <th colspan="4">{{$total}}</th>
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