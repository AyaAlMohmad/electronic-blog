@extends('layouts.app')
@section('content')

<div class="col-xl-8 col-lg-10 mx-auto">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ __('section Details') }}  {{ $section->id }}</h4>
        </div>
        <div class="card-content">
            <div class="card-body">

                
                <div class="row mt-2">
                    @foreach(config('app.locales') as $locale)
                    <div class="col-md-6">
                        <h5>{{ __('Name') }} ({{ strtoupper($locale) }})</h5>
                        <p>{{ $section->getTranslation('name', $locale) ?? '-' }}</p>
                    </div>
                    @endforeach
                </div>
                
                <div class="form-actions right mt-3">
                    <a href="{{ route('admin.sections.index') }}" class="btn btn-primary">
                        <i class="ft-arrow-left"></i> {{ __('Back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection