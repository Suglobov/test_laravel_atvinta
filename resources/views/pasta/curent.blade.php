@extends('layouts.app')

@section('content')
    <pre class="uk-container">
        {{ print_r($row, 1) }}
    </pre>
@endsection
