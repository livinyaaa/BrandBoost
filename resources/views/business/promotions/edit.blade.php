@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="background-color: pink">{{ __('Edit Promotion') }}</div>
                    <div class="card-body" style="background-color: #feeaed">
                        <form method="POST" action="{{ route('promotions.update', $promotion->promotion_id) }}">
                            @csrf
                            @method('PUT')

                            <!-- Product or Service Name -->
                            <div class="row mb-3">
                                <label for="product_service_name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Product or Service Name') }}</label>
                                <div class="col-md-6">
                                    <input id="product_service_name" type="text"
                                        class="form-control @error('product_service_name') is-invalid @enderror"
                                        name="product_service_name" value="{{ $promotion->product_service_name }}" required>
                                    @error('product_service_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Target Audience -->
                            <div class="row mb-3">
                                <label for="target_audience"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Target Audience') }}</label>
                                <div class="col-md-6">
                                    <input id="target_audience" type="text"
                                        class="form-control @error('target_audience') is-invalid @enderror"
                                        name="target_audience" value="{{ $promotion->target_audience }}" required>
                                    @error('target_audience')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="row mb-3">
                                <label for="description"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
                                <div class="col-md-6">
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required>{{ $promotion->description }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Discount Amount -->
                            <div class="row mb-3">
                                <label for="discount_amount"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Discount Amount') }}</label>
                                <div class="col-md-6">
                                    <input id="discount_amount" type="number" step="0.01"
                                        class="form-control @error('discount_amount') is-invalid @enderror"
                                        name="discount_amount" value="{{ $promotion->discount_amount }}" required>
                                    @error('discount_amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Start Date -->
                            <div class="row mb-3">
                                <label for="start_date"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Start Date') }}</label>
                                <div class="col-md-6">
                                    <input id="start_date" type="date"
                                        class="form-control @error('start_date') is-invalid @enderror" name="start_date"
                                        value="{{ $promotion->start_date }}" required>
                                    @error('start_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- End Date -->
                            <div class="row mb-3">
                                <label for="end_date"
                                    class="col-md-4 col-form-label text-md-end">{{ __('End Date') }}</label>
                                <div class="col-md-6">
                                    <input id="end_date" type="date"
                                        class="form-control @error('end_date') is-invalid @enderror" name="end_date"
                                        value="{{ $promotion->end_date }}" required>
                                    @error('end_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-10 offset-md-2 d-flex justify-content-end">
                                    <a href="{{ route('business.dashboard') }}" class="btn btn-light mr-2"
                                        style="border: 1px solid #08194a; color: #08194a; margin-right: 15px;">Go Back to
                                        Dashboard</a>
                                    <button type="submit" class="btn" style="background-color:#08194a; color:white">
                                        {{ __('Update Promotion') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
