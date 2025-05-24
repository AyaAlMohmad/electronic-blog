@extends('layouts.app')

@section('content')
<div class="container" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ __('Approve Writer') }}: {{ $user->name }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.writers.approve', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('Current User Info') }}</label>
                            <div class="form-control-plaintext">
                                <p><strong>{{ __('Name') }}:</strong> {{ $user->name }}</p>
                                <p><strong>{{ __('Email') }}:</strong> {{ $user->email }}</p>
                                @if($user->image_path)
                                    <img src="{{ $user->image_path }}" width="100" class="img-thumbnail mt-2">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{-- Bio in Arabic --}}
                        <div class="form-group">
                            <label for="bio_ar">{{ __('Biography (Arabic)') }}*</label>
                            <textarea name="bio[ar]" id="bio_ar" class="form-control" rows="3" required></textarea>
                        </div>

                        {{-- Bio in English --}}
                        <div class="form-group">
                            <label for="bio_en">{{ __('Biography (English)') }}*</label>
                            <textarea name="bio[en]" id="bio_en" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="subsection_id">{{ __('Subsection') }}*</label>
                            <select name="subsection_id" id="subsection_id" class="form-control" required>
                                <option value="">{{ __('Select Subsection') }}</option>
                                @foreach($subsections as $subsection)
                                    <option value="{{ $subsection->id }}">
                                        {{ $subsection->getTranslation('name', app()->getLocale()) }} -> {{ $subsection->section->getTranslation('name', app()->getLocale()) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="image">{{ __('Profile Image') }}</label>
                            <input type="file" name="image" id="image" class="form-control-file">
                            <small class="form-text text-muted">{{ __('Leave empty to use current profile image') }}</small>
                        </div>
                    </div>
                </div>

                <div class="form-group text-right mt-4">
                    <a href="{{ route('admin.writers.pending') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i> {{ __('Approve Writer') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
