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

@if($errors->any())
<x-adminlte-alert theme="warning" title="Warning">
    Something went wrong!
</x-adminlte-alert>
    
@endif

<form action="{{ route('dwelling.store') }}" method="post">
@csrf
<label for="name">Name*</label>
<x-adminlte-input id="name" name="name" value="{{ old('name') }}"/>

<label for="contact">Contact*</label>
<x-adminlte-input id="contact" name="contact" value="{{ old('contact') }}"/>

<label for="name">Address*</label>
<x-adminlte-input id="address" name="address" value="{{ old('address') }}"/>

<label for="name">Price</label>
<x-adminlte-input id="price" name="price" value="{{ old('price') }}"/>

<label for="name">Comments</label>
<x-adminlte-textarea id="comments" name="comments" placeholder="Insert comments..." value="{{ old('comments') }}"/>

<x-adminlte-button class="btn-flat" type="submit" label="Submit" theme="success" icon="fas fa-lg fa-save"/>

</form>
@stop