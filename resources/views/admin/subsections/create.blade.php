@extends('layouts.app')
@section('content')

<div class="col-xl-8 col-lg-10 mx-auto">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('admin.subsections.create.title')</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form action="{{ route('admin.subsections.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="section_id">@lang('admin.subsections.form.section')</label>
                        <select name="section_id" id="section_id" class="form-control" required>
                            <option value="">@lang('admin.subsections.create.select_section')</option>
                            @foreach($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->getTranslation('name', app()->getLocale()) }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="nav-tabs-top">
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach(config('app.locales') as $locale)
                            <li class="nav-item">
                                <a class="nav-link {{ $loop->first ? 'active' : '' }}" 
                                   data-toggle="tab" 
                                   href="#tab-{{ $locale }}" 
                                   aria-expanded="true">
                                   {{ strtoupper($locale) }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        
                        <div class="tab-content px-1 pt-1">
                            @foreach(config('app.locales') as $locale)
                            <div class="tab-pane {{ $loop->first ? 'active' : '' }}" 
                                 id="tab-{{ $locale }}" 
                                 aria-expanded="true" 
                                 role="tabpanel">
                                <div class="form-group">
                                    <label for="name_{{ $locale }}">
                                        @lang('admin.subsections.form.name') ({{ strtoupper($locale) }})
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="name_{{ $locale }}" 
                                           name="name[{{ $locale }}]" 
                                           placeholder="@lang('admin.subsections.form.name_placeholder', ['locale' => $locale])"
                                           {{ $loop->first ? 'required' : '' }}>
                                    @error('name.'.$locale)
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="form-actions right mt-3">
                        <a href="{{ route('admin.subsections.index') }}" class="btn btn-warning mr-1">
                            <i class="ft-x"></i> @lang('admin.subsections.create.cancel')
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check-square-o"></i> @lang('admin.subsections.create.submit')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection