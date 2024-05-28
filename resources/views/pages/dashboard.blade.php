@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'dashboard'
])

@section('content')
    <div class="p-4">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-12">
                                <div class="numbers">
                                    <i class="nc-icon nc-single-02"></i>
                                    <p class="card-category" style="color: black;">Employees</p>
                                    <p class="card-title">{{ count($employees) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="numbers">
                                    <i class="nc-icon nc-paper"></i>
                                    <p class="card-category" style="color: black;">Total Leave</p>
                                    <p class="card-title">{{ count($leaves) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="numbers">
                                <i class="nc-icon nc-check-2"></i>
                                    <p class="card-category" style="color: black;">Approved</p>
                                    <p class="card-title">{{ $leaveApproved }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="numbers">
                                <i class="nc-icon nc-alert-circle-i"></i>
                                    <p class="card-category">Pending</p>
                                    <p class="card-title">{{ $leavePending }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="numbers">
                                    <p class="">Employees</p>
                                </div>
                                <table class="table">
                                    <thead class="thead">
                                          <th>Employee's Name</th>  
                                          <th>Gender</th>  
                                          <th>Address</th>  
                                          <th>Phone</th>  
                                          <th>Department</th>  
                                          {{-- <th>Status</th>   --}}
                                          <th>Date Created</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($employees as $employee)
                                            <tr>
                                                <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                                <td>{{ $employee->gender }}</td>
                                                <td>{{ $employee->address }}</td>
                                                <td>{{ $employee->phone_number }}</td>
                                                <td>{{ $employee->department }}</td>
                                                <td>{{ \Carbon\Carbon::parse($employee->created_at)->format('F d Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-10">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="numbers">
                                    <p class="">Employee's leaves</p>
                                </div>
                                <table class="table">
                                    <thead class="thead">
                                          <th>Employee's Name</th>  
                                          <th>Start Date</th>  
                                          <th>End Date</th>  
                                          <th>Condition</th>  
                                          <th>Leave Type</th>  
                                          <th>Status</th>  
                                          <th>Applied</th>  
                                          <th>Action</th>  
                                    </thead>
                                    <tbody>
                                        @foreach ($leaves as $leave)
                                            <tr>
                                                <td>{{ $leave->name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('F d Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($leave->end_date)->format('F d Y') }}</td>
                                                <td>{{ $leave->reason }}</td>
                                                <td>{{ $leave->leavetypename }}</td>
                                                <td>{{ $leave->status }}</td>
                                                <td>{{ \Carbon\Carbon::parse($leave->created_at)->format('F d Y') }}</td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $leave->id }}">Delete</button>
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
        </div>
    </div>
@endsection 

@push('scripts')
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
            demo.initChartsPages();
        });

        $('.delete-btn').click(function() {
            var leavetype_id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this leave!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/leave/delete/' + leavetype_id,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire('Deleted!', response.message, 'success');
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            Swal.fire('Error!', 'Failed to delete leave. Please try again later.', 'error');
                        }
                    });
                }
            });
        });
    </script>
@endpush




