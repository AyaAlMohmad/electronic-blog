@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('admin.posts.approved.title')</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="mb-3">
                <a href="{{ route('admin.posts.pending') }}" class="btn btn-sm btn-primary">
                    <i class="ft-check"></i> @lang('admin.posts.approved.pending_button')
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>@lang('admin.posts.approved.table.id')</th>
                            <th>@lang('admin.posts.approved.table.title')</th>
                            <th>@lang('admin.posts.approved.table.writer')</th>
                            <th>@lang('admin.posts.approved.table.date')</th>
                            <th>@lang('admin.posts.approved.table.image')</th>
                            <th>@lang('admin.posts.approved.table.actions')</th>
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
                                    <span class="badge badge-light">@lang('admin.posts.details.no_image')</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-sm btn-outline-primary" title="@lang('admin.posts.approved.actions.view')">
                                    <i class="fas fa-eye"></i> 
                                </a>
                            
                                <form action="{{ route('admin.posts.approve', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-success" title="@lang('admin.posts.approved.actions.approve')" onclick="return confirm('@lang('admin.posts.approved.actions.confirm_approve')')">
                                        <i class="fas fa-check-circle"></i> 
                                    </button>
                                </form>
                            
                                <form action="{{ route('admin.posts.reject', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-warning" title="@lang('admin.posts.approved.actions.reject')" onclick="return confirm('@lang('admin.posts.approved.actions.confirm_reject')')">
                                        <i class="fas fa-times-circle"></i> 
                                    </button>
                                </form>
                            
                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="@lang('admin.posts.approved.actions.delete')" onclick="return confirm('@lang('admin.posts.approved.actions.confirm_delete')')">
                                        <i class="fas fa-trash-alt"></i> 
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">@lang('admin.posts.approved.table.no_data')</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection