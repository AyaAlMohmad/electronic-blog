@extends('layouts.app')
@section('content')

<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('admin.users.index.title')</h4>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse" title="@lang('admin.users.index.card.collapse')"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload" title="@lang('admin.users.index.card.reload')"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand" title="@lang('admin.users.index.card.expand')"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close" title="@lang('admin.users.index.card.close')"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>@lang('admin.users.index.table.name')</th>
                                    <th>@lang('admin.users.index.table.email')</th>
                                    <th>@lang('admin.users.index.table.image')</th>
                                    <th style="width: 120px">@lang('admin.users.index.table.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <img src="{{ $user->image_path }}" alt="{{ $user->name }}" width="100">
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('admin.users.show', $user->id) }}" 
                                               class="btn btn-sm btn-outline-primary" 
                                               title="@lang('admin.users.index.actions.view')">
                                                <i class="ft-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.users.edit', $user->id) }}" 
                                               class="btn btn-sm btn-outline-warning" 
                                               title="@lang('admin.users.index.actions.edit')">
                                                <i class="ft-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-outline-danger" 
                                                        title="@lang('admin.users.index.actions.delete')"
                                                        onclick="return confirm('@lang('admin.users.index.actions.delete_confirm')')">
                                                    <i class="ft-trash-2"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">@lang('admin.users.index.table.no_data')</td>
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