@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'employees'
])
@php
    use Illuminate\Support\Facades\Crypt;
@endphp

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
                    <h4 class="card-title d-inline-block" style="font-family: 'Montserrat', sans-serif;">Manage Employees</h4>
                    <button class="btn btn-info btn-sm float-right mt-3 add-btn">
                        Add Employee
                    </button>
                </div>
                <div class="card-body">
                    <div class="table">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    {{-- <th>ID</th> --}}
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
                                        {{-- <td>{{$employee->id}} </td> --}}
                                        <td>{{$employee->first_name}} </td>
                                        <td>{{$employee->middle_name}} </td>
                                        <td>{{$employee->last_name}} </td>
                                        <td>{{$employee->gender}} </td>
                                        <td>{{$employee->address}} </td>
                                        <td>{{$employee->phone_number}} </td>
                                        <td>{{$employee->department}} </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm edit-btn" data-id="{{ Crypt::encryptString($employee->id) }}">Edit</button>
                                            <button class="btn btn-danger btn-sm delete-btn" data-id="{{ Crypt::encryptString($employee->id) }}">Delete</button>
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
                        <select type="text" class="form-control" id="gender" name="gender" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Others</option>
                        </select>
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
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="department">Department</label>
                        <select type="text" class="form-control" id="department" name="department" required>
                            @foreach ($departments as $department)
                                <option value="{{ $department->department_name }}">{{ $department->department_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
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
                    <input type="hidden" id="edit_user_id" name="user_id">
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
                        <select type="text" class="form-control" id="edit_gender" name="gender" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Others</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_address">Address</label>
                        <input type="text" class="form-control" id="edit_address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_phonenumber">PhoneNumber</label>
                        <input type="number" class="form-control" id="edit_phonenumber" name="phonenumber" required>
                    </div>
                    <div class="form-group">
                        <label for="eemail">Email</label>
                        <input type="email" class="form-control" id="eemail" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="department">Department</label>
                        <select type="text" class="form-control" id="department" name="department" required>
                            @foreach ($departments as $department)
                                <option value="{{ $department->department_name }}">{{ $department->department_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="epassword">Password</label>
                        <input type="password" class="form-control" id="epassword" name="password">
                    </div>
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
                    var response = JSON.parse(xhr.responseText)
                    Swal.fire('Error!', response.message, 'error');
                }
            });
        });

        $('.edit-btn').click(function() {
            var employee_id = $(this).data('id');
            $.ajax({
                url: '/employees/' + employee_id + '/edit',
                type: 'GET',
                success: function(response) {
                    console.log(response[0].first_name)
                    $('#edit_user_id').val(response[0].id);
                    $('#edit_employee_id').val(employee_id);
                    $('#edit_firstname').val(response[0].first_name);
                    $('#edit_middlename').val(response[0].middle_name);
                    $('#edit_lastname').val(response[0].last_name);
                    $('#edit_gender').val(response[0].gender);
                    $('#edit_address').val(response[0].address);
                    $('#edit_phonenumber').val(response[0].phone_number);
                    $('#edit_department').val(response[0].department);
                    $('#eemail').val(response[0].email);
                    $('#editEmployeeModal').modal('show'); 
                },
                error: function(xhr) {
                    var msg = JSON.parse(xhr.responseText)
                    Swal.fire('Error!', msg , 'error');
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
                    var msg = JSON.parse(xhr.responseText)
                    Swal.fire('Error!', msg.message , 'error');
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