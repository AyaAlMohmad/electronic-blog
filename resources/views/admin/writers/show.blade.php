@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('admin.writers.show.title')</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if($writer->image)
                        <img src="{{ $writer->image }}" class="img-fluid rounded-circle mb-3" style="max-width: 200px;">
                    @endif
                    <h3>{{ $writer->name }}</h3>
                    <p class="text-muted">@lang('admin.writers.show.member_since', ['date' => $writer->user->created_at->format('M d, Y')])</p>
                </div>

                <div class="col-md-8">
                    <div class="mb-4">
                        <h5>@lang('admin.writers.show.biography')</h5>
                        <p>{{ $writer->bio }}</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title">@lang('admin.writers.show.user_info')</h6>
                                    <p><strong>@lang('admin.writers.approve.email'):</strong><a href="mailto:{{ $writer->user->email }}"> {{ $writer->user->email }}</a></p>
                                    <p><strong>@lang('admin.writers.show.status'):</strong> 
                                        <span class="badge badge-success">@lang('admin.writers.show.approved_writer')</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title">@lang('admin.writers.show.writer_details')</h6>
                                    <p><strong>@lang('admin.writers.approve.subsection'):</strong> {{ $writer->subsection->name }}</p>
                                    <p><strong>@lang('admin.writers.show.articles_written'):</strong> {{ $postCount }}</p>
                                    <p><strong>@lang('admin.writers.show.approved_on'):</strong> {{ $writer->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-right mt-3">
                        <a href="{{ route('admin.writers.approved') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> @lang('admin.writers.show.back_button')
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection