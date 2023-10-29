@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <table class="table">
        <tr>
            <th>Property</th>
            <th>Content</th>
        </tr>
        @foreach ($fields as $field)
        <tr>
            <th>{{$field}}</th>
            <td>{{$bill->$field}}</td>
        </tr>    
        @endforeach
        
    </table>
@endsection