
@extends('layouts.app')

@section('title', 'Update Student')

@section('content')
<div class="container mt-4">
    <img src="{{ asset('storage') }}/{{ $student[0]->image }}" alt="" style="max-width: 50px;">
    <form class="row g-4" id="updateForm">
        @csrf
        <div class="col-md-4">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" value="{{ $student[0]->name }}" class="form-control" id="name"
                required>
        </div>
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" value="{{ $student[0]->email }}" class="form-control"
                id="email" required>
        </div>
        <div class="col-md-6">
            <input type="file" name="file" class="form-label">
            <input type="hidden" class="form-control" value="{{ $student[0]->id }}" name="id">
        </div>
        <div class="col-md-6">
            <input type="submit" value="Update Student" id="btnSubmit">
        </div>
    </form>
</div>
<span id="output"></span>

<script>
    $(document).ready(function() {
        $("#updateForm").submit(function(event) {
            event.preventDefault();

            var form = $("#updateForm")[0];
            var data = new FormData(form);

            $.ajax({
                type: "POST",
                url: "{{ route('updateStudent') }}",
                data: data,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#output').text(response.success);

                    // Redirect to the students index page after a delay
                    setTimeout(function() {
                        window.location.href = "/students";
                    }, 2000); // 2000 milliseconds (2 seconds) delay, adjust as needed
                },
                error: function(err) {
                    $('#output').text(err.responseText);
                }
            });

        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
@endsection
