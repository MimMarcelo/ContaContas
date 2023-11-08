@extends('layouts.master')

<?php $edit = isset($bill); ?>
@section('title', ($edit?'Update':'Create').' bill')

@section('content')
        @if ($edit)
        <form action="{{ route('bills.update', $bill->id) }}"
            method="post" class="container">
            @method("PUT")
        @else
        <form action="{{ route('bills.store') }}"
            method="post" class="container">
        @endif
        @csrf
        <div class="form-group">
            <label for="name">Name: </label>
            <input type="text" name="name" id="name" class="form-control"
                {{ $edit? "value=".$bill->name:"" }}>
        </div>
        <div class="form-group">
            <label for="value">Value: </label>
            <input type="number" step=".01" name="value" id="value" class="form-control"
                {{ $edit? "value=".$bill->value:"" }}>
        </div>
        <div class="form-group">
            <label for="from">From: </label>
            <select name="from" id="from" class="form-control">
                <option value="0" disabled>Select</option>
                @foreach ($sources as $s)
                    <option value="{{$s->id}}"
                        {{ $edit?$bill->selected("from", $s->id):"" }}>
                        {{$s->name}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="to">To: </label>
            <select name="to" id="to" class="form-control">
                @foreach ($sources as $s)
                    <option value="{{$s->id}}"
                        {{ $edit?$bill->selected("to", $s->id):"" }}>
                        {{$s->name}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="entry">Entry: </label>
            <input type="date" name="entry" id="entry" class="form-control"
            value={{ $edit?$bill->entry:date('Y-m-d') }}>
        </div>
        <input type="submit" value="Save" class="btn btn-primary">
        <a href="{{ route('bills.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection