@extends('layouts.app')
@section('content')

<div class="col-xl-8 col-lg-10 mx-auto">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('admin.about_us.show.title', ['id' => $about_us->id])</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row mt-2">
                    @foreach(config('app.locales') as $locale)
                    <div class="col-md-6">
                        <h5>@lang('admin.about_us.show.title_label') ({{ strtoupper($locale) }})</h5>
                        <p>{{ $about_us->getTranslation('title', $locale) ?? '-' }}</p>
                    </div>
                    @endforeach
                </div>
                
                <div class="row mt-2">
                    @foreach(config('app.locales') as $locale)
                    <div class="col-md-6">
                        <h5>@lang('admin.about_us.show.description_label') ({{ strtoupper($locale) }})</h5>
                        <p>{{ $about_us->getTranslation('description', $locale) ?? '-' }}</p>
                    </div>
                    @endforeach
                </div>
                
                <div class="row mt-2">
                    @foreach(config('app.locales') as $locale)
                    <div class="col-md-6">
                        <h5>@lang('admin.about_us.show.short_description_label') ({{ strtoupper($locale) }})</h5>
                        <p>{{ $about_us->getTranslation('short_description', $locale) ?? '-' }}</p>
                    </div>
                    @endforeach
                </div>
                
                <div class="row mt-2">
                    <div class="col-md-6">
                        <h5>@lang('admin.about_us.show.image_label')</h5>
                        <img src="{{ asset('storage/'.$about_us->image) }}" class="img-fluid" alt="">
                    </div>
                </div>
                
                <div class="form-actions right mt-3">
                    <a href="{{ route('admin.about_us.index') }}" class="btn btn-primary">
                        <i class="ft-arrow-left"></i> @lang('admin.about_us.show.back_button')
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection