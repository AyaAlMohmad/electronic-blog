@extends('layouts.app')
@section('content')
<div class="col-xl-8 col-lg-10 mx-auto">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('admin.about_us.edit.title')</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form action="{{ route('admin.about_us.update',$about_us->id) }}" method="POST" enctype="multipart/form-data">
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
                                    <label for="title_{{ $locale }}">
                                        @lang('admin.about_us.show.title_label') ({{ strtoupper($locale) }})
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="title_{{ $locale }}" 
                                           name="title[{{ $locale }}]" 
                                           value="{{ $about_us->getTranslation('title', $locale) }}"
                                           placeholder="@lang('admin.about_us.edit.title_placeholder', ['locale' => $locale])"
                                           {{ $loop->first ? 'required' : '' }}>
                                    @error('title.'.$locale)
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description_{{ $locale }}">
                                        @lang('admin.about_us.show.description_label') ({{ strtoupper($locale) }})
                                    </label>
                                    <textarea class="form-control" 
                                              id="description_{{ $locale }}" 
                                              name="description[{{ $locale }}]" 
                                              placeholder="@lang('admin.about_us.edit.description_placeholder', ['locale' => $locale])"
                                              {{ $loop->first ? 'required' : '' }}>{{ $about_us->getTranslation('description', $locale) }}</textarea>
                                    @error('description.'.$locale)
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="short_description_{{ $locale }}">
                                        @lang('admin.about_us.show.short_description_label') ({{ strtoupper($locale) }})
                                    </label>
                                    <textarea class="form-control" 
                                              id="short_description_{{ $locale }}" 
                                              name="short_description[{{ $locale }}]" 
                                              placeholder="@lang('admin.about_us.edit.short_description_placeholder', ['locale' => $locale])"
                                              {{ $loop->first ? 'required' : '' }}>{{ $about_us->getTranslation('short_description', $locale) }}</textarea>
                                    @error('short_description.'.$locale)
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="image">@lang('admin.about_us.show.image_label')</label>
                        <img src="{{ asset('storage/'.$about_us->image) }}" class="img-fluid mb-2" alt="">
                        <input type="file" class="form-control" id="image" name="image">
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-actions right mt-3">
                        <a href="{{ route('admin.about_us.index') }}" class="btn btn-warning mr-1">
                            <i class="ft-x"></i> @lang('admin.about_us.edit.cancel')
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check-square-o"></i> @lang('admin.about_us.edit.submit')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection