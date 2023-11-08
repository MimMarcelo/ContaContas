@extends('layouts.master')

@section('title', 'Home')

@section('content')
    
    <div class="row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card" style="width: 18rem;">
                <div class="card-header">
                    Resume
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($sources as $source => $total)
                    <li class="list-group-item">
                        {{$source." R$ ".$total}}
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Value</th>
                <th>Entry</th>
                <th>From</th>
                <th>To</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        @foreach ($bills as $b)
            <tr>
                <td>{{$b->id}}</td>
                <td>
                    <a href="{{route('bills.show', $b)}}">{{$b->name}}</a>
                </td>
                <td>{{sprintf("R$ %0.2f", $b->value)}}</td>
                <td>{{date_format(new DateTime($b->entry), "d/m/y")}}</td>
                <td>{{$b->from()->name}}</td>
                <td>{{$b->to()->name}}</td>
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