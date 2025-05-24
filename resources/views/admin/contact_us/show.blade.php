@extends('layouts.app')
@section('content')

<div class="col-xl-8 col-lg-10 mx-auto">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('admin.contact_us.show.title')</h4>
        </div>
        <div class="card-content">
            <div class="card-body">

                <div class="row mt-2">
                    <div class="col-md-6">
                        <h5>@lang('admin.contact_us.show.email')</h5>
                        <p>{{ $contact_us->email ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>@lang('admin.contact_us.show.phone')</h5>
                        <p>{{ $contact_us->phone ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>@lang('admin.contact_us.show.fax')</h5>
                        <p>{{ $contact_us->fax ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>@lang('admin.contact_us.show.map_url')</h5>
                        <p>
                            @if ($contact_us->map)
                                <a href="{{ $contact_us->map }}" target="_blank">{{ $contact_us->map }}</a>
                            @else
                                -
                            @endif
                        </p>
                    </div>
                </div>

                <hr>

                <div class="row mt-2">
                    @foreach(config('app.locales') as $locale)
                    <div class="col-md-6">
                        <h5>@lang('admin.contact_us.show.address') ({{ strtoupper($locale) }})</h5>
                        <p>{{ $contact_us->getTranslation('address', $locale) ?? '-' }}</p>
                    </div>
                    @endforeach
                </div>

                <div class="form-actions right mt-3">
                    <a href="{{ route('admin.contact_us.index') }}" class="btn btn-primary">
                        <i class="ft-arrow-left"></i> @lang('admin.contact_us.show.back_button')
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection