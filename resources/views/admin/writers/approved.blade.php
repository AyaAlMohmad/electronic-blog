@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('admin.writers.approved.title')</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>@lang('admin.writers.approved.table.id')</th>
                            <th>@lang('admin.writers.approved.table.name')</th>
                            <th>@lang('admin.writers.approved.table.email')</th>
                            <th>@lang('admin.writers.approved.table.profile')</th>
                            <th>@lang('admin.writers.approved.table.actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($writers as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->writer && $user->writer->image)
                                    <img src="{{ $user->writer->image }}" width="50" class="rounded-circle">
                                @else
                                    <span class="badge badge-light">@lang('admin.writers.approved.table.no_image')</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.writers.show', $user->writer->id) }}" 
                                   title="@lang('admin.writers.approved.actions.view')"  
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> 
                                </a>
                                <form action="{{ route('admin.writers.revoke', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-warning" 
                                            title="@lang('admin.writers.approved.actions.revoke')" 
                                            onclick="return confirm('@lang('admin.writers.approved.actions.revoke_confirm')')">
                                        <i class="fas fa-user-minus"></i> 
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">@lang('admin.writers.approved.table.no_data')</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection