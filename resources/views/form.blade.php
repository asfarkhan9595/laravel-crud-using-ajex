@extends('layouts.app')

@section('title', 'Add Students')

@section('content')
    <div class="container mt-4">
        <h2>Add Student</h2>
        <div class="text-end">
            <a class="btn btn-success" href="{{ route('students') }}">Student List</a>
        </div>
        <form class="row g-3" id="myform">
            @csrf
            <div class="col-md-6">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>


            <div class="col-md-6">
                <label for="file" class="form-label">Choose File</label>
                <input type="file" class="form-control" name="file" id="file">
            </div>
            <div class="col-md-6">
                <input type="submit" value="Add Student" id="btnSubmit">
            </div>
        </form>
        <span id="output"></span>
    </div>
    <script>
        $(document).ready(function() {
            $('#myform').submit(function(event) {
                event.preventDefault();

                var form = $('#myform')[0];
                var data = new FormData(form);

                $('#btnSubmit').prop('disabled', true);

                $.ajax({
                    type: "POST",
                    url: "{{ route('addstudent') }}",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $('#output').text(data.result);
                        $('#btnSubmit').prop('disabled', false);
                        $("input[type='text']").val('');
                        $("input[type='email']").val('');
                        $("input[type='file']").val('');
                        window.location.href = "/";
                    },
                    error: function(e) {
                        $('#output').text(e.responseText);
                        $('#btnSubmit').prop('disabled', false);
                        $("input[type='text']").val('');
                        $("input[type='email']").val('');
                        $("input[type='file']").val('');

                    }
                })
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
@endsection