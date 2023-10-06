@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: pink">Business Dashboard</div>
                <div class="card-body" style="background-color: #feeaed">

                    <div class="mb-4">
                        <h4>Hey, {{ Auth::user()->name }}!</h4>
                        <p>Manage your promotions from here.</p>
                    </div>

                    <!-- Placeholder table for Promotions -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="text-align: left; padding: 8px 12px; white-space: nowrap;">Select</th> <!-- New column header for checkboxes -->
                                <th style="text-align: left; padding: 8px 12px; white-space: nowrap;">Promotion ID</th>
                                <th style="text-align: left; padding: 8px 12px; white-space: nowrap;">Product or Service</th>
                                <th style="text-align: left; padding: 8px 12px; white-space: nowrap;">Target Audience</th>
                                <th style="text-align: left; padding: 8px 12px; white-space: nowrap;">Description</th>
                                <th style="text-align: left; padding: 8px 12px; white-space: nowrap;">Start Date</th>
                                <th style="text-align: left; padding: 8px 12px; white-space: nowrap;">End Date</th>
                                <th style="text-align: left; padding: 8px 12px; white-space: nowrap;">Discount Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($promotions as $promotion)
                            <tr>
                                <td style="text-align: left; padding: 8px 12px; white-space: nowrap;"><input type="checkbox" name="selectedPromo" class="promoCheckbox" data-id='{{$promotion->promotion_id}}' value="{{ $promotion->promotion_id }}"></td> <!-- New column for checkboxes -->
                                <td style="text-align: left; padding: 8px 12px; white-space: nowrap;">{{ $promotion->promotion_id }}</td>
                                <td style="text-align: left; padding: 8px 12px; white-space: nowrap;">{{ $promotion->product_service_name }}</td>
                                <td style="text-align: left; padding: 8px 12px; white-space: nowrap;">{{ $promotion->target_audience }}</td>
                                <td style="text-align: left; padding: 8px 12px; white-space: nowrap;">{{ $promotion->description }}</td>
                                <td style="text-align: left; padding: 8px 12px; white-space: nowrap;">{{ $promotion->start_date }}</td>
                                <td style="text-align: left; padding: 8px 12px; white-space: nowrap;">{{ $promotion->end_date }}</td>
                                <td style="text-align: left; padding: 8px 12px; white-space: nowrap;">{{ $promotion->discount_amount }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                    <!-- Buttons -->
                    <div class="mb-4 d-flex">
                        <a href="{{ route('promotions.create') }}" class="btn" style="background-color:#08194a; color:white; margin-right: 15px;">Create New Promotion</a>
                        <a href="#" id="editPromo" class="btn" style="background-color:#08194a; color:white; margin-right: 15px;">Edit Promotion</a>
                        <a href="#" id="deletePromo" class="btn btn-danger">Delete Promotion</a>
                    </div>                                                      

                </div>
            </div>
        </div>
    </div>
</div>



    <script>
        document.addEventListener("DOMContentLoaded", function(){
            document.getElementById('editPromo').addEventListener('click', function(event) {
                event.preventDefault();  
                let selectedCheckbox = Array.from(document.querySelectorAll('.promoCheckbox')).find(checkbox => checkbox.checked);
                if (selectedCheckbox) {
                    let promotionId = selectedCheckbox.getAttribute('data-id');
                    window.location.href = `/business/promotions/${promotionId}/edit`;
                } else {
                    alert('Please select a promotion to edit.');
                }
            });
        
            document.getElementById('deletePromo').addEventListener('click', function(event) {
                event.preventDefault();
                
                let selectedCheckboxes = Array.from(document.querySelectorAll('.promoCheckbox')).filter(checkbox => checkbox.checked);
                if (selectedCheckboxes.length) {
                    if(confirm('Are you sure you want to delete the selected promotions?')) {
                        selectedCheckboxes.forEach(checkbox => {
                            let promotionId = checkbox.getAttribute('data-id');
                            fetch(`/business/promotions/delete/${promotionId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    checkbox.closest('tr').remove();
                                }
                            });
                        });
                    }
                } else {
                    alert('Please select promotions to delete.');
                }
            });
        });
        </script>   
@endsection

