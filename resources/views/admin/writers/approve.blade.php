@extends('layouts.app')

@section('content')
<div class="container" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('admin.writers.approve.title', ['name' => $user->name])</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.writers.approve', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('admin.writers.approve.current_info')</label>
                            <div class="form-control-plaintext">
                                <p><strong>@lang('admin.writers.approve.name'):</strong> {{ $user->name }}</p>
                                <p><strong>@lang('admin.writers.approve.email'):</strong> {{ $user->email }}</p>
                                @if($user->image_path)
                                    <img src="{{ $user->image_path }}" width="100" class="img-thumbnail mt-2">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bio_ar">@lang('admin.writers.approve.bio_ar')*</label>
                            <textarea name="bio[ar]" id="bio_ar" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="bio_en">@lang('admin.writers.approve.bio_en')*</label>
                            <textarea name="bio[en]" id="bio_en" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="subsection_id">@lang('admin.writers.approve.subsection')*</label>
                            <select name="subsection_id" id="subsection_id" class="form-control" required>
                                <option value="">@lang('admin.writers.approve.select_subsection')</option>
                                @foreach($subsections as $subsection)
                                    <option value="{{ $subsection->id }}">
                                        {{ $subsection->getTranslation('name', app()->getLocale()) }} -> {{ $subsection->section->getTranslation('name', app()->getLocale()) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="image">@lang('admin.writers.approve.profile_image')</label>
                            <input type="file" name="image" id="image" class="form-control-file">
                            <small class="form-text text-muted">@lang('admin.writers.approve.keep_current_image')</small>
                        </div>
                    </div>
                </div>

                <div class="form-group text-right mt-4">
                    <a href="{{ route('admin.writers.pending') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> @lang('admin.writers.approve.back')
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i> @lang('admin.writers.approve.approve_button')
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection