@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Writer Profile</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if($writer->image)
                        <img src="{{  $writer->image }}" class="img-fluid rounded-circle mb-3" style="max-width: 200px;">
                    @endif
                    <h3>{{ $writer->name }}</h3>
                    <p class="text-muted">Member since: {{ $writer->user->created_at->format('M d, Y') }}</p>
                </div>

                <div class="col-md-8">
                    <div class="mb-4">
                        <h5>Biography</h5>
                        <p>{{ $writer->bio }}</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title">User Information</h6>
                                    <p><strong>Email:</strong><a href="mailto:{{ $writer->user->email }}"> {{ $writer->user->email }}</a></p>
                                    <p><strong>Status:</strong> 
                                        <span class="badge badge-success">Approved Writer</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title">Writer Details</h6>
                                    <p><strong>Subsection:</strong> {{ $writer->subsection->name }}</p>
                                    <p><strong>Articles Written:</strong> {{ $postCount }}</p>
                                    <p><strong>Approved On:</strong> {{ $writer->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-right mt-3">
                        <a href="{{ route('admin.writers.approved') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection