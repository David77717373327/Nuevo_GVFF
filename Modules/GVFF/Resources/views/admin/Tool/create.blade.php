@extends('gvff::layouts.master')

@section('content')
<div class="container">
    <h2>Nueva Herramienta</h2>

    <form action="{{ route('gvff.admin.tools.store') }}" method="POST">
        @csrf

        <div>
            <label for="name">Nombre:</label>
            <input type="text" name="name" required>
        </div>

        <div>
            <label for="description">Descripción:</label>
            <textarea name="description"></textarea>
        </div>

        <button type="submit">Guardar</button>
    </form>
</div>
@endsection
