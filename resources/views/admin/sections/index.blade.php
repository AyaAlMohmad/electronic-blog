@extends('layouts.app')
@section('content')

<!-- Section table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('admin.sections.title')</h4>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse" title="@lang('admin.sections.card.collapse')"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload" title="@lang('admin.sections.card.reload')"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand" title="@lang('admin.sections.card.expand')"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close" title="@lang('admin.sections.card.close')"><i class="ft-x"></i></a></li>
                            <li>
                                <a href="{{ route('admin.sections.create') }}" class="btn btn-sm btn-primary">
                                    <i class="ft-plus"></i> @lang('admin.sections.create_button')
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
                                    <th>@lang('admin.sections.table.name_ar')</th>
                                    <th>@lang('admin.sections.table.name_en')</th>
                                    <th>@lang('admin.sections.table.image')</th>
                                    <th style="width: 120px">@lang('admin.sections.table.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sections as $section)
                                <tr>
                                    <td>{{ $section->getTranslation('name', 'ar') ?? '-' }}</td>
                                    <td>{{ $section->getTranslation('name', 'en') ?? '-' }}</td>
                                    <td>
                                        <img src="{{ asset('storage/'. $section->image) }}" alt="{{ $section->name }}" width="100">
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('admin.sections.show', $section->id) }}" 
                                               class="btn btn-sm btn-outline-primary" 
                                               title="@lang('admin.sections.actions.view')">
                                                <i class="ft-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.sections.edit', $section->id) }}" 
                                               class="btn btn-sm btn-outline-warning" 
                                               title="@lang('admin.sections.actions.edit')">
                                                <i class="ft-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.sections.destroy', $section->id) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-outline-danger" 
                                                        title="@lang('admin.sections.actions.delete')"
                                                        onclick="return confirm('@lang('admin.sections.actions.delete_confirm')')">
                                                    <i class="ft-trash-2"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">@lang('admin.sections.table.no_data')</td>
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