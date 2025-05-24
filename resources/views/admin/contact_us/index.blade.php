@extends('layouts.app')
@section('content')

<!-- Contact Us Table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('admin.contact_us.index.title')</h4>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse" title="@lang('admin.contact_us.index.card.collapse')"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload" title="@lang('admin.contact_us.index.card.reload')"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand" title="@lang('admin.contact_us.index.card.expand')"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close" title="@lang('admin.contact_us.index.card.close')"><i class="ft-x"></i></a></li>
                            <li>
                                <a href="{{ route('admin.contact_us.create') }}" class="btn btn-sm btn-primary">
                                    <i class="ft-plus"></i> @lang('admin.contact_us.index.create_button')
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
                                    <th>@lang('admin.contact_us.index.table.email')</th>
                                    <th>@lang('admin.contact_us.index.table.phone')</th>
                                    <th>@lang('admin.contact_us.index.table.fax')</th>
                                    <th>@lang('admin.contact_us.index.table.map')</th>
                                    <th>@lang('admin.contact_us.index.table.address_ar')</th>
                                    <th>@lang('admin.contact_us.index.table.address_en')</th>
                                    <th style="width: 120px">@lang('admin.contact_us.index.table.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($contact_us as $contact)
                                    <tr>
                                        <td>{{ $contact->email ?? '-' }}</td>
                                        <td>{{ $contact->phone ?? '-' }}</td>
                                        <td>{{ $contact->fax ?? '-' }}</td>
                                        <td>{{ $contact->map ?? '-' }}</td>
                                        <td>{{ $contact->getTranslation('address', 'ar') ?? '-' }}</td>
                                        <td>{{ $contact->getTranslation('address', 'en') ?? '-' }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('admin.contact_us.show', $contact->id) }}" 
                                                   class="btn btn-sm btn-outline-primary" 
                                                   title="@lang('admin.contact_us.index.actions.view')">
                                                    <i class="ft-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.contact_us.edit', $contact->id) }}" 
                                                   class="btn btn-sm btn-outline-warning" 
                                                   title="@lang('admin.contact_us.index.actions.edit')">
                                                    <i class="ft-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.contact_us.destroy', $contact->id) }}" 
                                                      method="POST" 
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-outline-danger" 
                                                            title="@lang('admin.contact_us.index.actions.delete')"
                                                            onclick="return confirm('@lang('admin.contact_us.index.actions.delete_confirm')')">
                                                        <i class="ft-trash-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">@lang('admin.contact_us.index.table.no_data')</td>
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