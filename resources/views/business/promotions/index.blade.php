@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color: pink">{{ __('Promotions') }}</div>
                    <div class="card-body" style="background-color: #feeaed">
                        <a href="{{ route('promotions.create') }}" class="btn btn-primary mb-3">Create New Promotion</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Promotion ID</th>
                                    <th>Product or Service Name</th>
                                    <th>Target Audience</th>
                                    <th>Description</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Discount</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($promotions as $promotion)
                                    <tr>
                                        <td>{{ $promotion->id }}</td>
                                        <td>{{ $promotion->product_service_name }}</td>
                                        <td>{{ $promotion->target_audience }}</td>
                                        <td>{{ $promotion->description }}</td>
                                        <td>{{ $promotion->start_date }}</td>
                                        <td>{{ $promotion->end_date }}</td>
                                        <td>{{ $promotion->discount }}%</td>
                                        <td>
                                            <a href="{{ route('promotions.edit', $promotion->id) }}"
                                                class="btn btn-warning">Edit</a>
                                            <form action="{{ route('promotions.destroy', $promotion->id) }}"
                                                method="DELETE" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
