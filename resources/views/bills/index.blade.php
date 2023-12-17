@extends('layouts.master')

@section('title', 'Bills')

@section('content')

    <div class="row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card" style="width: 18rem;">
                <div class="card-header">
                    Resume
                </div>
                <ul class="list-group list-group-flush">
                    {{-- @foreach ($sources as $source => $total)
                        <li class="list-group-item">
                            {{ $source . " R$ " . $total }}
                        </li>
                    @endforeach --}}
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
                <td>{{ $b->id }}</td>
                <td>
                    <a href="{{ route('bills.show', $b) }}">{{ $b->name }}</a>
                </td>
                <td>{{ $b->currency()->code . sprintf(" %0.2f", $b->value) }}</td>
                <td>{{ date_format(new DateTime($b->entry), 'd/m/y') }}</td>
                <td>{{ $b->from()->name }}</td>
                <td>{{ $b->to()->name }}</td>
                <td>
                    <a href="{{ route('bills.edit', $b) }}" class="material-symbols-outlined btn btn-warning">edit</a>
                </td>
                <td>
                    <form action="{{ route('bills.destroy', $b->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="delete" class="material-symbols-outlined btn btn-danger">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <button type="button" title="Add new Bill" id="add"
        class="fixed-bottom btn btn-primary material-symbols-outlined filled fixed-button" data-bs-toggle="modal"
        data-bs-target="#createBillModal">
        add
    </button>
    <div class="modal fade" id="createBillModal" tabindex="-1" aria-labelledby="createBillModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createBillModalLabel">Add New Bill</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name="formCreateBill">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="form-label">Bill</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="value" class="form-label">Value</label>
                            <input type="number" step="0.01" class="form-control" id="value" name="value">
                        </div>
                        <div class="form-group">
                            <label for="entry" class="form-label">Entry</label>
                            <input type="date" class="form-control" id="entry" name="entry"
                                value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="form-group">
                            <label for="from" class="form-label">From</label>
                            <select type="text" class="form-control" id="from" name="from">
                                <option value="">Select</option>
                                @foreach ($sources as $s)
                                    <option value="{{ $s->id }}">
                                        {{ $s->code . ' - ' . $s->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="to" class="form-label">To</label>
                            <select type="text" class="form-control" id="to" name="to">
                                <option value="">Select</option>
                                @foreach ($sources as $s)
                                    <option value="{{ $s->id }}">
                                        {{ $s->code . ' - ' . $s->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="parcels" class="form-label">Parcels</label>
                            <input type="number" step="1" class="form-control" id="parcels" name="parcels" value="1">
                        </div>
                        <input type="submit" class="btn btn-primary" value="Create">
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('bills.js')
@endsection
