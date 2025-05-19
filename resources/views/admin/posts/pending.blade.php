@extends('layouts.app')

@section('content')
    <section id="configuration">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Pending Posts</h4>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                                <li>
                                    <a href="{{ route('admin.posts.approved') }}" class="btn btn-sm btn-primary">
                                        <i class="ft-check"></i> Approved Posts
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Writer</th>
                                        <th>Date</th>
                                        <th>Image</th>
                                        <th>Action Type</th>
                                        <th style="width: 150px">Actions</th>
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
                                                @if ($post->image)
                                                    <img src="{{ $post->image }}" width="50" class="rounded">
                                                @else
                                                    <span class="badge badge-light">No Image</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($post->action_type === 'create')
                                                    <span class="badge badge-success">New</span>
                                                @else
                                                    <span class="badge badge-warning">Edited</span>
                                                @endif
                                            </td>
                                            <td>
                                               <a href="{{ route('admin.posts.show', $post->id) }}"
                                                    class="btn btn-sm btn-outline-primary" title="View">
                                                    <i class="ft-eye"></i>
                                                </a>
                                            
                                               <form action="{{ route('admin.posts.approve', $post->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-success" title="Approve">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            
                                               <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"
                                                        onclick="return confirm('Are you sure?')">
                                                        <i class="ft-trash-2"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No pending posts found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
