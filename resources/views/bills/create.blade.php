@extends('layouts.master')

<?php 
$edit = isset($bill);
$kinds = ["values" => ["C", "D"], "options" => ["Credit", "Debit"]];

?>
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
            <label for="kind">Kind: </label>
            <select name="kind" id="kind" class="form-control" autofocus>
                @for ($i = 0; $i < count($kinds["values"]); $i++)
                    <option value='{{$kinds["values"][$i]}}'
                        {{ $edit?$bill->selected($kinds["values"][$i]):"" }}>
                        {{ $kinds["options"][$i] }}
                    </option>
                @endfor
            </select>
        </div>
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
            <label for="entry">Entry: </label>
            <input type="date" name="entry" id="entry" value="{{date('Y-m-d')}}" class="form-control"
                {{ $edit? "value=".$bill->entry:"" }}>
        </div>
        <input type="submit" value="Save" class="btn btn-primary">
        <a href="{{ route('bills.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection