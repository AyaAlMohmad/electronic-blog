@extends('layouts.app')
@section('content')

<!-- Section table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">About Us</h4>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                            <li>
                                <a href="{{ route('admin.about_us.create') }}" class="btn btn-sm btn-primary">
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
                                    <th>Title (AR)</th>
                                    <th>Title (EN)</th>
                                    {{-- <th>Description (AR)</th>
                                    <th>Description (EN)</th> --}}
                                    <th>Short Description (AR)</th>
                                    <th>Short Description (EN)</th>
                                    <th>Image</th>
                                    <th style="width: 120px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($about_us as $about)
                                <tr>
                                    <td>{{ $about->getTranslation('title', 'ar') ?? '-' }}</td>
                                    <td>{{ $about->getTranslation('title', 'en') ?? '-' }}</td>
                                    {{-- <td>{{ $about->getTranslation('description', 'ar') ?? '-' }}</td>
                                   <td>{{ $about->getTranslation('description', 'en') ?? '-' }}</td> --}}
                                    <td>{{ $about->getTranslation('short_description', 'ar') ?? '-' }}</td>
                                    <td>{{ $about->getTranslation('short_description', 'en') ?? '-' }}</td>
                                    <td>
                                        <img src="{{ asset('storage/'.$about->image) }}" 
                                             alt="about us image" 
                                             style="width: 100px; height: 100px;">
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('admin.about_us.show', $about->id) }}" 
                                               class="btn btn-sm btn-outline-primary" 
                                               title="View">
                                                <i class="ft-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.about_us.edit', $about->id) }}" 
                                               class="btn btn-sm btn-outline-warning" 
                                               title="Edit">
                                                <i class="ft-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.about_us.destroy', $about->id) }}" 
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