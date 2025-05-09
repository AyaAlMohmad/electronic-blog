@extends('layouts.app')
@section('content')
<div class="col-xl-8 col-lg-10 mx-auto">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ __('Create Contact Info') }}</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form action="{{ route('admin.contact_us.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="email">{{ __('Email') }}</label>
                        <input type="email" 
                               class="form-control" 
                               id="email" 
                               name="email" 
                               placeholder="{{ __('Enter email') }}" 
                               value="{{ old('email') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">{{ __('Phone') }}</label>
                        <input type="text" 
                               class="form-control" 
                               id="phone" 
                               name="phone" 
                               placeholder="{{ __('Enter phone') }}" 
                               value="{{ old('phone') }}">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="fax">{{ __('Fax') }}</label>
                        <input type="text" 
                               class="form-control" 
                               id="fax" 
                               name="fax" 
                               placeholder="{{ __('Enter fax') }}" 
                               value="{{ old('fax') }}">
                        @error('fax')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="map">{{ __('Map URL') }}</label>
                        <input type="text" 
                               class="form-control" 
                               id="map" 
                               name="map" 
                               placeholder="{{ __('Enter map link') }}" 
                               value="{{ old('map') }}">
                        @error('map')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
                                    <label for="address_{{ $locale }}">
                                        {{ __('Address') }} ({{ strtoupper($locale) }})
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="address_{{ $locale }}" 
                                           name="address[{{ $locale }}]" 
                                           placeholder="{{ __('Enter address in :locale', ['locale' => $locale]) }}"
                                           value="{{ old('address.'.$locale) }}">
                                    @error('address.'.$locale)
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-actions right mt-3">
                        <a href="{{ route('admin.contact_us.index') }}" class="btn btn-warning mr-1">
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
