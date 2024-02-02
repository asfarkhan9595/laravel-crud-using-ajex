@extends('layouts.app')

@section('title', 'Students')

@section('content')
    <div class="container mt-4">
        <table class="table table-bordered table-striped" id="student-table">
            <H2>Student List</H2>
            <div class="text-end">
                <a class="btn btn-success" href="{{ route('addstudent') }}">Add student</a>
            </div>
            <thead>
                <span id="output"></span>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>


            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: "{{ route('getstudent') }}",
                success: function(data) {

                    if (data.studentlist.length > 0) {
                        for (let i = 0; i < data.studentlist.length; i++) {
                            let student = data.studentlist[i];
                            let img = student.image;
                            $("#student-table tbody").append(`
                            <tr>
                                <th scope="row">${student.id}</th>
                                <td>${student.name}</td>
                                <td>${student.email}</td>
                                <td><img src="{{ asset('storage') }}/${img}" alt="Student Image" style="max-width: 50px;"></td>
                                <td> <a href ="edit/${student.id}" data-toggle="modal" data-target=".bd-example-modal-lg">Edit</a>
                                    <button class="delete-student" data-student-id="${student.id}">Delete</button>
                                    </td>
                               

                            </tr>
                        `);
                        }
                    } else {
                        ("#student-table").append("<tr><td colspan='4'>Data Not Found</td></tr>")
                    }
                },
                error: function(err) {
                    console.log(err.responseText)
                }
            });
            $('#student-table').on('click', '.delete-student', function() {
                var id = $(this).attr('data-student-id');
                var obj = $(this);
                if (confirm('Are you sure you want to deleste this student?')) {
                    $.ajax({
                        type: 'GET',
                        url: '/delete/' + id,
                        success: function(response) {
                            // alert(response.result);
                            $(obj).parent().parent().remove();
                            
                           
                        },
                        error: function(err) {
                            console.error(err.responseText);
                        }
                    });
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
@endsection
