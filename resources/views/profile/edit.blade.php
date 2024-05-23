@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'edit'
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
                    <h4 class="card-title d-inline-block" style="font-family: 'Montserrat', sans-serif;">Manage Departments</h4>
                    <button class="btn btn-info btn-sm float-right mt-3 add-btn">
                        Add Department
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Department Name</th>
                                    <th>Department ShortName</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($departments as $department)
                                    <tr>
                                        <td>{{$department->id}} </td>
                                        <td>{{$department->department_name}} </td>
                                        <td>{{$department->department_shortname}} </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm edit-btn" data-id="{{ $department->id }}">Edit</button>
                                            <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $department->id }}">Delete</button>
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


<div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDepartmentModalLabel">Add New Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addDepartmentForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="department_name">Department_Name</label>
                        <input type="text" class="form-control" id="department_name" name="department_name" required>
                    </div>
                    <div class="form-group">
                        <label for="department_shortname">Department_ShortName</label>
                        <input type="text" class="form-control" id="department_shortname" name="department_shortname" required>
                    </div>
                    <!-- <div class="form-group">
                        <label for="lastname">LastName</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" required> -->
                    <!-- </div>
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
                </div> -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Add Department</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add modal for editing department -->
<div class="modal fade" id="editDepartmentModal" tabindex="-1" aria-labelledby="editDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDepartmentModalLabel">Edit Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editDepartmentForm">
                <div class="modal-body">
                    <input type="hidden" id="edit_department_id" name="id">
                    <div class="form-group">
                        <label for="edit_department_name">Department_Name</label>
                        <input type="text" class="form-control" id="edit_department_name" name="department_name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_department_shortname">Department_ShortName</label>
                        <input type="text" class="form-control" id="edit_department_shortname" name="edit_department_shortname" required>
                    </div>
                    <!-- <div class="form-group">
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
                </div> -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Department</button>
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
            $('#addDepartmentModal').modal('show');
        });

        $('#addDepartmentForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route("departments.store") }}',
                type: 'POST',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire('Success!', 'Department added successfully', 'success');
                    $('#addDepartmentModal').modal('hide');
                    location.reload();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    Swal.fire('Error!', 'An error occurred. Please try again later.', 'error');
                }
            });
        });

        $('.edit-btn').click(function() {
            var department_id = $(this).data('id');
            $.ajax({
                url: '/departments/' + department_id + '/edit',
                type: 'GET',
                success: function(response) {
                    $('#edit_department_id').val(response.id);
                    $('#edit_department_name').val(response.department_name);
                    $('#edit_department_shortname').val(response.department_shortname);
                    $('#editDepartmentModal').modal('show'); 
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    Swal.fire('Error!', 'An error occurred. Please try again later.', 'error');
                }
            });
        });

        $('#editDepartmentForm').submit(function(e) {
            e.preventDefault();
            var department_id = $('#edit_department_id').val();
            $.ajax({
                url: '/departments/' + department_id,
                type: 'PUT',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire('Success!', 'Department updated successfully', 'success');
                    $('#editDepartmentModal').modal('hide');
                    location.reload();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    Swal.fire('Error!', 'An error occurred. Please try again later.', 'error');
                }
            });
        });

        $('.delete-btn').click(function() {
            var department_id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this department data!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/departments/' + department_id,
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
                            Swal.fire('Error!', 'Failed to delete department. Please try again later.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>