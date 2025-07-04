@extends('layouts.app')

@section('content')
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('admin.writers.pending.title')</h4>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse" title="@lang('admin.writers.pending.card.collapse')"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload" title="@lang('admin.writers.pending.card.reload')"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand" title="@lang('admin.writers.pending.card.expand')"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close" title="@lang('admin.writers.pending.card.close')"><i class="ft-x"></i></a></li>
                            <li>
                                <a href="{{ route('admin.writers.approved') }}" class="btn btn-sm btn-primary">
                                    <i class="ft-user"></i> @lang('admin.writers.pending.approved_button')
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
                                    <th>@lang('admin.writers.pending.table.id')</th>
                                    <th>@lang('admin.writers.pending.table.name')</th>
                                    <th>@lang('admin.writers.pending.table.email')</th>
                                    <th>@lang('admin.writers.pending.table.profile')</th>
                                    <th style="width: 120px">@lang('admin.writers.pending.table.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendingWriters as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->image_path)
                                                <img src="{{ $user->image_path }}" width="50" class="rounded-circle">
                                            @else
                                                <span class="badge badge-light">@lang('admin.writers.pending.table.no_image')</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.writers.approve-form', $user->id) }}"
                                               class="btn btn-sm btn-outline-success" 
                                               title="@lang('admin.writers.pending.actions.approve')">
                                                <i class="fas fa-check"></i> 
                                            </a>
                                            <form action="{{ route('admin.writers.reject', $user->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('@lang('admin.writers.pending.actions.reject_confirm')')" 
                                                    title="@lang('admin.writers.pending.actions.reject')">
                                                    <i class="fas fa-times"></i> 
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">@lang('admin.writers.pending.table.no_data')</td>
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