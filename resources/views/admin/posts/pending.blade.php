@extends('layouts.app')

@section('content')
    <section id="configuration">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('admin.posts.pending.title')</h4>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse" title="@lang('admin.posts.pending.card.collapse')"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload" title="@lang('admin.posts.pending.card.reload')"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand" title="@lang('admin.posts.pending.card.expand')"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close" title="@lang('admin.posts.pending.card.close')"><i class="ft-x"></i></a></li>
                                <li>
                                    <a href="{{ route('admin.posts.approved') }}" class="btn btn-sm btn-primary">
                                        <i class="ft-check"></i> @lang('admin.posts.pending.approved_button')
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
                                        <th>@lang('admin.posts.pending.table.id')</th>
                                        <th>@lang('admin.posts.pending.table.title')</th>
                                        <th>@lang('admin.posts.pending.table.writer')</th>
                                        <th>@lang('admin.posts.pending.table.date')</th>
                                        <th>@lang('admin.posts.pending.table.image')</th>
                                        <th>@lang('admin.posts.pending.table.action_type')</th>
                                        <th style="width: 150px">@lang('admin.posts.pending.table.actions')</th>
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
                                                    <span class="badge badge-light">@lang('admin.posts.details.no_image')</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($post->action_type === 'create')
                                                    <span class="badge badge-success">@lang('admin.posts.pending.table.new')</span>
                                                @else
                                                    <span class="badge badge-warning">@lang('admin.posts.pending.table.edited')</span>
                                                @endif
                                            </td>
                                            <td>
                                               <a href="{{ route('admin.posts.show', $post->id) }}"
                                                    class="btn btn-sm btn-outline-primary" title="@lang('admin.posts.pending.actions.view')">
                                                    <i class="ft-eye"></i>
                                                </a>
                                            
                                               <form action="{{ route('admin.posts.approve', $post->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-success" title="@lang('admin.posts.pending.actions.approve')">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            
                                               <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="@lang('admin.posts.pending.actions.delete')"
                                                        onclick="return confirm('@lang('admin.posts.pending.actions.confirm_delete')')">
                                                        <i class="ft-trash-2"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">@lang('admin.posts.pending.table.no_data')</td>
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