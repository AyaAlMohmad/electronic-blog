@extends('layouts.app')
@section('content')
<div class="col-xl-8 col-lg-10 mx-auto">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('admin.contact_us.edit.title')</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form action="{{ route('admin.contact_us.update', $contact_us->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="email">@lang('admin.contact_us.show.email')</label>
                        <input type="email" 
                               class="form-control" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', $contact_us->email) }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">@lang('admin.contact_us.show.phone')</label>
                        <input type="text" 
                               class="form-control" 
                               id="phone" 
                               name="phone" 
                               value="{{ old('phone', $contact_us->phone) }}">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="fax">@lang('admin.contact_us.show.fax')</label>
                        <input type="text" 
                               class="form-control" 
                               id="fax" 
                               name="fax" 
                               value="{{ old('fax', $contact_us->fax) }}">
                        @error('fax')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="map">@lang('admin.contact_us.show.map_url')</label>
                        <input type="url" 
                               class="form-control" 
                               id="map" 
                               name="map" 
                               value="{{ old('map', $contact_us->map) }}">
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
                                   href="#tab-{{ $locale }}">
                                   {{ strtoupper($locale) }}
                                </a>
                            </li>
                            @endforeach
                        </ul>

                        <div class="tab-content px-1 pt-1">
                            @foreach(config('app.locales') as $locale)
                            <div class="tab-pane {{ $loop->first ? 'active' : '' }}" id="tab-{{ $locale }}">
                                <div class="form-group">
                                    <label for="address_{{ $locale }}">
                                        @lang('admin.contact_us.show.address') ({{ strtoupper($locale) }})
                                    </label>
                                    <input type="text"
                                           class="form-control"
                                           id="address_{{ $locale }}"
                                           name="address[{{ $locale }}]"
                                           value="{{ old('address.'.$locale, $contact_us->getTranslation('address', $locale)) }}">
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
                            <i class="ft-x"></i> @lang('admin.contact_us.edit.cancel')
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check-square-o"></i> @lang('admin.contact_us.edit.submit')
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection