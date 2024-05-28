@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'fileleave'
])

@section('content')
    <div class="p-4 mt-5 d-flex justify-content-center align-items-center ">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @if ($Leaves >= 15)
                                    <div class="numbers text-center text-danger">
                                        <p class="mx-5 px-5 text-xl">You've reached your limit. You already have 15 leaves pending or approved this year</p>
                                    </div>
                                @else
                                    <div class="numbers text-center">
                                        <p class="mx-5 px-5">Request leave form</p>
                                    </div>
                                    <div>
                                        <form id='fileleave'>
                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <label for="start_date" class="form-label">Start Date</label>
                                                    <input type="date" class="form-control" id="start_date" name="start_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="end_date" class="form-label">End Date</label>
                                                    <input type="date" class="form-control" id="end_date" name="end_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="leave_type" class="form-label">Leave type</label>
                                                <select class="form-control" id="leave_type" name="leave_type">
                                                    @foreach ($LeaveTypes as $LeaveType)
                                                        @if ($LeaveType["remaining"] < 1)
                                                            <option value="{{ $LeaveType['id'] }}" disabled>{{ $LeaveType["name"] }} ( 0 left )</option>
                                                        @else
                                                            <option value="{{ $LeaveType["id"] }}">{{ $LeaveType["name"] }} ({{ $LeaveType["remaining"] }} left)</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="reason" class="form-label">Condition:</label>
                                                <textarea class="form-control" id="reason" name="reason" rows="5"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Request Leave</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 

@push('scripts')
    <script>
        $('#fileleave').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route("storeleave") }}',
                type: 'POST',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire('Success!', 'LeaveType added successfully', 'success');
                    $('#addLeaveTypeModal').modal('hide');
                    location.reload();
                },
                error: function(xhr) {
                    var msg = JSON.parse(xhr.responseText)
                    Swal.fire('Error!', msg.message , 'error');
                }
            });
        });

        $(document).ready(function() {
            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
            // demo.initChartsPages();
        });
    </script>
@endpush




