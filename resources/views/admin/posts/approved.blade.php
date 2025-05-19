@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Approved Posts</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <li>
                <a href="{{ route('admin.posts.pending') }}" class="btn btn-sm btn-primary">
                    <i class="ft-check"></i> pending Posts
                </a>
            </li>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Writer</th>
                            <th>Date</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->writer?->name ?? 'N/A' }}</td>
                            <td>{{ $post->date ?? 'N/A' }}</td>
                            <td>
                                @if($post->image)
                                    <img src="{{ $post->image }}" width="60" class="rounded">
                                @else
                                    <span class="badge badge-light">No Image</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> 
                                </a>
                            
                                <form action="{{ route('admin.posts.approve', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-success" onclick="return confirm('Are you sure to approve this post?')">
                                        <i class="fas fa-check-circle"></i> 
                                    </button>
                                </form>
                            
                                <form action="{{ route('admin.posts.reject', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-warning" onclick="return confirm('Are you sure to reject this post?')">
                                        <i class="fas fa-times-circle"></i> 
                                    </button>
                                </form>
                            
                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure to delete this post?')">
                                        <i class="fas fa-trash-alt"></i> 
                                    </button>
                                </form>
                            </td>
                            
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No approved posts found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
