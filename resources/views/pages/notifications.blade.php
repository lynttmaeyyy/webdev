@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'map'
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
        <div class="col-md-9 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-inline-block" style="font-family: 'Montserrat', sans-serif;">Manage Employees</h4>
                    <button class="btn btn-info btn-sm float-right mt-3 add-btn">
                        Add Employee
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>Phone Number</th>
                                    <th>Department</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>{{$employee->id}} </td>
                                        <td>{{$employee->first_name}} </td>
                                        <td>{{$employee->middle_name}} </td>
                                        <td>{{$employee->last_name}} </td>
                                        <td>{{$employee->gender}} </td>
                                        <td>{{$employee->address}} </td>
                                        <td>{{$employee->phone_number}} </td>
                                        <td>{{$employee->department}} </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm edit-btn" data-id="{{ $employee->id }}">Edit</button>
                                            <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $employee->id }}">Delete</button>
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


<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
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
</div>

@endsection
</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('.add-btn').click(function() {
            $('#addEmployeeModal').modal('show');
        });

        $('#addEmployeeForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route("employees.store") }}',
                type: 'POST',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire('Success!', 'Employee added successfully', 'success');
                    $('#addEmployeeModal').modal('hide');
                    location.reload();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    Swal.fire('Error!', 'An error occurred. Please try again later.', 'error');
                }
            });
        });

        $('.edit-btn').click(function() {
            var employee_id = $(this).data('id');
            $.ajax({
                url: '/employees/' + employee_id + '/edit',
                type: 'GET',
                success: function(response) {
                    $('#edit_employee_id').val(response.id);
                    $('#edit_firstname').val(response.firstname);
                    $('#edit_middlename').val(response.middlename);
                    $('#edit_lastname').val(response.lastname);
                    $('#edit_gender').val(response.gender);
                    $('#edit_address').val(response.address);
                    $('#edit_phonenumber').val(response.phonenumber);
                    $('#edit_department').val(response.department);
                    $('#editEmployeeModal').modal('show'); 
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    Swal.fire('Error!', 'An error occurred. Please try again later.', 'error');
                }
            });
        });

        $('#editEmployeeForm').submit(function(e) {
            e.preventDefault();
            var employee_id = $('#edit_employee_id').val();
            $.ajax({
                url: '/employees/' + employee_id,
                type: 'PUT',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire('Success!', 'Employee updated successfully', 'success');
                    $('#editEmployeeModal').modal('hide');
                    location.reload();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    Swal.fire('Error!', 'An error occurred. Please try again later.', 'error');
                }
            });
        });

        $('.delete-btn').click(function() {
            var employee_id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this employee data!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/employees/' + employee_id,
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
                            Swal.fire('Error!', 'Failed to delete employee. Please try again later.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>