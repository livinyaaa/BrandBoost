@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <h2>Businesses</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Address</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
                @foreach($businesses as $business)
                <tr>
                    <td>{{ $business->name }}</td>
                    <td>{{ $business->description }}</td>
                    <td>{{ $business->address }}</td>
                    <td>{{ $business->phone }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
