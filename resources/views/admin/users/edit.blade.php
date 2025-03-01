@extends('fornt.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('admin.sidebar')
            </div>
            <div class="col-lg-9">
                @include('fornt.message')
                <div class="card border-0 shadow mb-4">
                    <form action="{{ route('account.updateProfile') }}" method="POST" name="userForm" id="userForm">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="mb-2">Name*</label>
                            <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control" value="{{ $user->name }}">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="mb-2">Email*</label>
                            <input type="text" name="email" id="email" placeholder="Enter Email" class="form-control" value="{{ $user->email }}">
                        </div>
                        <div class="mb-4">
                            <label for="desgination" class="mb-2">Designation</label>
                            <input type="text" name="desgination" id="desgination" placeholder="Designation" class="form-control" value="{{ $user->desgination }}">
                        </div>
                        <div class="mb-4">
                            <label for="number" class="mb-2">Mobile</label>
                            <input type="text" name="mobile" id="number" placeholder="Mobile" class="form-control" value="{{ $user->mobile }}">
                        </div>
                        <div class="card-footer p-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div> 
            </div>
        </div>
    </div>
</section>
@endsection

@section('customjs')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
    $("#userForm").submit(function(event){
        event.preventDefault(); 
        $.ajax({
            url: '{{ route("admin.users.update", $user->id) }}',
            type: 'post',
            dataType: 'json',
            data: $(this).serialize(), 
            success: function(response) {
                if (response.status == true) {
                    $("#name").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('');

                    $("#email").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('');

                    window.location.href = "{{ route('admin.users') }}";
                } else {
                    var errors = response.errors;
                    if (errors.name) {
                        $("#name").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.name);
                    } else {
                        $("#name").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');
                    }
                    if (errors.email) {
                        $("#email").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.email);
                    } else {
                        $("#email").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');
                    }
                }
            }
        });
    });
</script>
@endsection
