@extends('layouts.master')

<?php 
$edit = isset($source);

?>
@section('title', ($edit?'Update':'Create').' source')

@section('content')
        @if ($edit)
        <form action="{{ route('sources.update', $source->id) }}"
            method="post" class="container">
            @method("PUT")
        @else
        <form action="{{ route('sources.store') }}"
            method="post" class="container">
        @endif
        @csrf
        <div class="form-group">
            <label for="kind">Kind: </label>
            <input type="text" name="kind" id="kind" class="form-control"
                {{ $edit? "value=".$source->kind:"" }}>
        </div>
        <div class="form-group">
            <label for="name">Name: </label>
            <input type="text" name="name" id="name" class="form-control"
                {{ $edit? "value=".$source->name:"" }}>
        </div>
        <input type="submit" value="Save" class="btn btn-primary">
        <a href="{{ route('sources.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection