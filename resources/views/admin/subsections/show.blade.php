@extends('layouts.app')
@section('content')

<div class="col-xl-8 col-lg-10 mx-auto">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('admin.subsections.show.title', ['id' => $subsection->id])</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>@lang('admin.subsections.show.section')</h5>
                        <p>{{ $subsection->section->getTranslation('name', app()->getLocale()) }}</p>
                    </div>
                </div>
                
                <div class="row mt-2">
                    @foreach(config('app.locales') as $locale)
                    <div class="col-md-6">
                        <h5>@lang('admin.subsections.form.name') ({{ strtoupper($locale) }})</h5>
                        <p>{{ $subsection->getTranslation('name', $locale) ?? '-' }}</p>
                    </div>
                    @endforeach
                </div>
                
                <div class="form-actions right mt-3">
                    <a href="{{ route('admin.subsections.index') }}" class="btn btn-primary">
                        <i class="ft-arrow-left"></i> @lang('admin.subsections.show.back_button')
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection