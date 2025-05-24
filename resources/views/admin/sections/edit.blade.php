@extends('layouts.app')
@section('content')
<div class="col-xl-8 col-lg-10 mx-auto">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('admin.sections.edit.title')</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form action="{{ route('admin.sections.update',$section->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
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
                                        @lang('admin.sections.form.name') ({{ strtoupper($locale) }})
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="name_{{ $locale }}" 
                                           name="name[{{ $locale }}]" 
                                           value="{{ $section->getTranslation('name', $locale) }}"
                                           placeholder="@lang('admin.sections.form.name_placeholder', ['locale' => $locale])">
                                    @error('name.'.$locale)
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="image">@lang('admin.sections.form.image')</label>
                        <img src="{{ asset('storage/'. $section->image) }}" alt="{{ $section->name }}" class="img-thumbnail mb-2" width="100">
                        <input type="file" class="form-control" id="image" name="image">
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-actions right mt-3">
                        <a href="{{ route('admin.sections.index') }}" class="btn btn-warning mr-1">
                            <i class="ft-x"></i> @lang('admin.sections.edit.cancel')
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check-square-o"></i> @lang('admin.sections.edit.submit')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection