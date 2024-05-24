@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'dashboard'
])

@section('content')
    <div class="p-4 d-flex justify-content-center align-items-center ">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 px-5 py-3">
                                <div class="numbers text-center">
                                    <p class="">All of your leaves</p>
                                </div>
                                <table class="table">
                                    <thead class="thead">
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
                                                <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('F d Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($leave->end_date)->format('F d Y') }}</td>
                                                <td>{{ $leave->reason }}</td>
                                                <td>{{ $leave->leave_type }}</td>
                                                <td>{{ $leave->status }}</td>
                                                <td>{{ \Carbon\Carbon::parse($leave->created_at)->format('F d Y') }}</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm edit-btn" data-id="{{ $leave->id }}">Edit</button>
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
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEmployeeModalLabel">Edit Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editleave">
                    <div class="modal-body">
                        <input type="hidden" id="leaveID" name="leaveID">
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
                                    <option value="{{ $LeaveType->name }}">{{ $LeaveType->name }}</option>
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
        </div>
    </div>
@endsection 

@push('scripts')
    <script>
        $('.edit-btn').click(function() {
            $('#editModal').modal('show');
        });

        $('.edit-btn').click(function() {
            var leaveID = $(this).data('id');
            $.ajax({
                url: '/getleave/' + leaveID,
                type: 'GET',
                success: function(response) {
                    $('#leaveID').val(leaveID);
                    $('#start_date').val(response.start_date);
                    $('#end_date').val(response.end_date);
                    $('#leave_type').val(response.leave_type);
                    $('#reason').val(response.reason);
                    $('#editModal').modal('show'); 
                },
                error: function(xhr) {
                    // console.log(xhr.responseText);
                    Swal.fire('Error!', 'An error occurred. Please try again later.', 'error');
                }
            });
        });

        $('#editleave').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route("saveleave") }}',
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




