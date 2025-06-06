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
                    <div class="card-body card-form">
                         <div class="d-flex justify-content-between">
                             <h3 class="fs-4 mb-1"> Job Application</h3>
                         </div>
                         <div class="table-responsive">
                             <table class="table">
                                 <thead class="bg-light">
                                     <tr>
                                         <th scope="col">Job Title</th>
                                         <th class="col">User</th>
                                         <th class="col">Employer</th>
                                         <th scope="col">Status</th>
                                         <th scope="col">Applied Date</th>
                                         <th scope="col">Action</th>
                                     </tr>
                                 </thead>
                                 <tbody class="border-0">
                                    
                                    @if ($applications->isNotEmpty())
                                    @foreach ($applications as $application)
                                    <tr>
                                        <td>
                                             <p>{{ $application->job->title }}</p>
                                        </td>
                                        <td>{{ $application->user->name }}</td>
                                        <td>{{ $application->employer->name }}</td>
                                        <td>
                                            @if ($application->job->status == 1)
                                                <a class="text-success">Active</a>
                                            @else
                                                <p class="text-danger">Block</p>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($application->applied_date)->format('d M Y') }}</td>
                                        <td>
                                            <div class="action-dots">
                                                <button class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                               </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" onclick="deleteJobApplication({{ $application->id }})" href="javascript:void(0);"><i class="fa fa-trash"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customjs')
{{-- 
<script type="text/javascript">
    function deleteJob(id) {
        if (confirm("Are you sure you want to delete this job?")) {
            $.ajax({
                url: '{{ route("admin.jobs.destroy") }}',
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === true) {
                        window.location.href = '{{ route("admin.jobs") }}';
                    } else {
                        alert('Error: Job could not be deleted.');
                    }
                }
            });
        }
    }
</script> 
--}}
@endsection
