@extends('layouts.app')
@section('content')

<!-- Contact Us Table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Contact Information</h4>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                            <li>
                                <a href="{{ route('admin.contact_us.create') }}" class="btn btn-sm btn-primary">
                                    <i class="ft-plus"></i> Create New
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
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Fax</th>
                                    <th>Map</th>
                                    <th>Address (AR)</th>
                                    <th>Address (EN)</th>
                                    <th style="width: 120px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contact_us as $contact)
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
                                                   title="View">
                                                    <i class="ft-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.contact_us.edit', $contact->id) }}" 
                                                   class="btn btn-sm btn-outline-warning" 
                                                   title="Edit">
                                                    <i class="ft-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.contact_us.destroy', $contact->id) }}" 
                                                      method="POST" 
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-outline-danger" 
                                                            title="Delete"
                                                            onclick="return confirm('Are you sure?')">
                                                        <i class="ft-trash-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
