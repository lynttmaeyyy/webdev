@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'leaves'
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
@section('content')
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-inline-block" style="font-family: 'Montserrat', sans-serif;">Manage Leaves</h4>
                    {{-- <button class="btn btn-info btn-sm float-right mt-3 add-btn">
                        Add Employee
                    </button> --}}
                </div>
                <div class="card-body">
                    <div class="table">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    {{-- <th>ID</th> --}}
                                    <th>Employee Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Condition</th>
                                    <th>Leave Type</th>
                                    <th>Applied</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($leaves as $leave)
                                    <tr>
                                        {{-- <td>{{$leave->id}} </td> --}}
                                        <td>{{$leave->name}} </td>
                                        <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('F d Y') }} </td>
                                        <td>{{ \Carbon\Carbon::parse($leave->end_date)->format('F d Y') }} </td>
                                        <td>{{$leave->reason}} </td>
                                        <td>{{$leave->leave_type}} </td>
                                        <td>{{ \Carbon\Carbon::parse($leave->created_at)->format('F d Y')}} </td>
                                        <td>{{$leave->status}} </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm approve-btn" data-id="{{ $leave->id }}">Approved</button>
                                            <button class="btn btn-danger btn-sm reject-btn" data-id="{{ $leave->id }}">Reject</button>
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


{{-- <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmployeeModalLabel">Add New Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addEmployeeForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="firstname">FirstName</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>
                    <div class="form-group">
                        <label for="middlename">MiddleName</label>
                        <input type="text" class="form-control" id="middlename" name="middlename" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">LastName</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <input type="text" class="form-control" id="gender" name="gender" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="phonenumber">PhoneNumber</label>
                        <input type="text" class="form-control" id="phonenumber" name="phonenumber" required>
                    </div>
                    <div class="form-group">
                        <label for="department">Department</label>
                        <input type="text" class="form-control" id="department" name="department" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Add Employee</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add modal for editing employee -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEmployeeModalLabel">Edit Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editEmployeeForm">
                <div class="modal-body">
                    <input type="hidden" id="edit_employee_id" name="id">
                    <div class="form-group">
                        <label for="edit_firstname">FirstName</label>
                        <input type="text" class="form-control" id="edit_firstname" name="firstname" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_middlename">MiddleName</label>
                        <input type="text" class="form-control" id="edit_middlename" name="middlename" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_lastname">LastName</label>
                        <input type="text" class="form-control" id="edit_lastname" name="lastname" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_gender">Gender</label>
                        <input type="text" class="form-control" id="edit_gender" name="gender" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_address">Address</label>
                        <input type="text" class="form-control" id="edit_address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_phonenumber">PhoneNumber</label>
                        <input type="text" class="form-control" id="edit_phonenumber" name="phonenumber" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_department">Department</label>
                        <input type="text" class="form-control" id="edit_department" name="department" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Employee</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}

@endsection
</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {

        $('.reject-btn').click(function() {
            var employee_id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will reject this leave!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, reject it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/users-leave/reject/' + employee_id,
                        type: 'put',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire('Rejected!', response.message, 'success');
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            Swal.fire('Error!', 'Failed to reject leave. Please try again later.', 'error');
                        }
                    });
                }
            });
        });

        $('.approve-btn').click(function() {
            var employee_id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, approve it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/users-leave/approve/' + employee_id,
                        type: 'put',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire('Approved!', response.message, 'success');
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            Swal.fire('Error!', 'Failed to approve leave. Please try again later.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>