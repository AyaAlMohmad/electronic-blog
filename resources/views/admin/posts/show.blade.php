@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Post Details</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if($post->image)
                        <img src="{{ $post->image }}" class="img-fluid rounded mb-3" style="max-width: 300px;">
                    @else
                        <span class="badge badge-light">No Image</span>
                    @endif

                    @if($post->video)
                        <div class="mt-3">
                            <video controls width="100%">
                                <source src="{{ $post->video }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    @endif
                </div>

                <div class="col-md-8">
                    <h3>{{ $post->title }}</h3>
                    <p class="text-muted">Date: {{ $post->date }}</p>

                    <div class="mb-3">
                        <h5>Short Description</h5>
                        <p>{{ $post->short_description }}</p>
                    </div>

                    <div class="mb-3">
                        <h5>Description</h5>
                        <p>{!! nl2br(e($post->description)) !!}</p>
                    </div>

                    <div class="mb-4">
                        <h5>Writer</h5>
                        <p><strong>{{ $post->writer->name ?? 'Unknown' }}</strong></p>
                    </div>

                    <div class="text-right">
                        <a href="{{ route('admin.posts.approved') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
