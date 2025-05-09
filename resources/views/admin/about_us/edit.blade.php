@extends('layouts.app')
@section('content')
<div class="col-xl-8 col-lg-10 mx-auto">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ __('Edit About Us') }}</h4>
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
                                    <label for="name_{{ $locale }}">
                                        {{ __('Title') }} ({{ strtoupper($locale) }})
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="name_{{ $locale }}" 
                                           name="title[{{ $locale }}]" 
                                           value="{{ $about_us->getTranslation('title', $locale) }}"
                                           placeholder="{{ __('Enter title in :locale', ['locale' => $locale]) }}"
                                           {{ $loop->first ? 'required' : '' }}>
                                    @error('title.'.$locale)
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description_{{ $locale }}">
                                        {{ __('Description') }} ({{ strtoupper($locale) }})
                                    </label>
                                    <textarea class="form-control" 
                                              id="description_{{ $locale }}" 
                                              name="description[{{ $locale }}]" 
                                              placeholder="{{ __('Enter description in :locale', ['locale' => $locale]) }}"
                                              {{ $loop->first ? 'required' : '' }}>
                                        {{ $about_us->getTranslation('description', $locale) }}
                                    </textarea>
                                    @error('description.'.$locale)
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="short_description_{{ $locale }}">
                                        {{ __('Short Description') }} ({{ strtoupper($locale) }})
                                    </label>
                                    <textarea class="form-control" 
                                              id="short_description_{{ $locale }}" 
                                              name="short_description[{{ $locale }}]" 
                                              placeholder="{{ __('Enter short description in :locale', ['locale' => $locale]) }}"
                                              {{ $loop->first ? 'required' : '' }}>
                                        {{ $about_us->getTranslation('short_description', $locale) }}
                                    </textarea>
                                    @error('short_description.'.$locale)
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="image">{{ __('Image') }}</label>
                                    <img src="{{ asset('storage/'.$about_us->image) }}" class="img-fluid" alt="">
                                    <input type="file" class="form-control" id="image" name="image" >
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    
                    
                    <div class="form-actions right mt-3">
                        <a href="{{ route('admin.about_us.index') }}" class="btn btn-warning mr-1">
                            <i class="ft-x"></i> {{ __('Cancel') }}
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check-square-o"></i> {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection