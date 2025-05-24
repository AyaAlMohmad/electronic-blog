@extends('layouts.app')
@section('content')

<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('admin.subsections.index.title')</h4>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse" title="@lang('admin.subsections.index.card.collapse')"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload" title="@lang('admin.subsections.index.card.reload')"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand" title="@lang('admin.subsections.index.card.expand')"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close" title="@lang('admin.subsections.index.card.close')"><i class="ft-x"></i></a></li>
                            <li>
                                <a href="{{ route('admin.subsections.create') }}" class="btn btn-sm btn-primary">
                                    <i class="ft-plus"></i> @lang('admin.subsections.index.create_button')
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>@lang('admin.subsections.index.table.name_ar')</th>
                                    <th>@lang('admin.subsections.index.table.name_en')</th>
                                    <th>@lang('admin.subsections.index.table.section')</th>
                                    <th style="width: 120px">@lang('admin.subsections.index.table.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subsections as $subsection)
                                <tr>
                                    <td>{{ $subsection->getTranslation('name', 'ar') ?? '-' }}</td>
                                    <td>{{ $subsection->getTranslation('name', 'en') ?? '-' }}</td>
                                    <td>{{ $subsection->section->getTranslation('name', app()->getLocale()) }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('admin.subsections.show', $subsection->id) }}" 
                                               class="btn btn-sm btn-outline-primary" 
                                               title="@lang('admin.subsections.index.actions.view')">
                                                <i class="ft-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.subsections.edit', $subsection->id) }}" 
                                               class="btn btn-sm btn-outline-warning" 
                                               title="@lang('admin.subsections.index.actions.edit')">
                                                <i class="ft-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.subsections.destroy', $subsection->id) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-outline-danger" 
                                                        title="@lang('admin.subsections.index.actions.delete')"
                                                        onclick="return confirm('@lang('admin.subsections.index.actions.delete_confirm')')">
                                                    <i class="ft-trash-2"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">@lang('admin.subsections.index.table.no_data')</td>
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