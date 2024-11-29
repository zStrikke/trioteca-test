@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')

{{-- Content body: main page content --}}

@section('content_body')
    @if (session('status'))
        <x-adminlte-alert theme="success" title="Success">
            {{ session('status') }}
        </x-adminlte-alert>
    @endif

    @error('invalidTransition')
        <x-adminlte-alert theme="warning" title="Warning">
            {{ $message }}
        </x-adminlte-alert>
    @enderror

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Contact</th>
                <th scope="col">Address</th>
                <th scope="col">Price</th>
                <th scope="col">Comments</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dwellings as $dwelling)
                <tr>
                    <form action="{{ route('dwelling.updateStatus', ['dwelling' => $dwelling]) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <td>{{ $dwelling->id }}</td>
                        <td>{{ $dwelling->name }}</td>
                        <td>{{ $dwelling->contact }}</td>
                        <td>{{ $dwelling->address }}</td>
                        <td>{{ $dwelling->price }}</td>
                        <td>{{ $dwelling->comments }}</td>
                        <td>
                            <select name="status" id="status">
                                @foreach (App\Enums\DwellingStatus::values() as $key => $value)
                                    <option value="{{ $value }}" @selected($dwelling->status->value == $value)>
                                        {{ Str::ucfirst($value) }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-primary" type="submit">Update</button>
                            <a href="{{ route('dwelling.show.logs', ['dwelling' => $dwelling]) }}" class="btn btn-xs btn-default text-teal mx-1 shadow" role="button" aria-pressed="true">Logs</a>
                        </td>
                    </form>
                </tr>
            @empty
                <tr>
                    <td>
                        {{ __('No data') }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@stop
