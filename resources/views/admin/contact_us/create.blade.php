@extends('layouts.app')
@section('content')
<div class="col-xl-8 col-lg-10 mx-auto">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('admin.contact_us.create.title')</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form action="{{ route('admin.contact_us.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="email">@lang('admin.contact_us.show.email')</label>
                        <input type="email" 
                               class="form-control" 
                               id="email" 
                               name="email" 
                               placeholder="@lang('admin.contact_us.create.email_placeholder')" 
                               value="{{ old('email') }}">
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
                               placeholder="@lang('admin.contact_us.create.phone_placeholder')" 
                               value="{{ old('phone') }}">
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
                               placeholder="@lang('admin.contact_us.create.fax_placeholder')" 
                               value="{{ old('fax') }}">
                        @error('fax')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="map">@lang('admin.contact_us.show.map_url')</label>
                        <input type="text" 
                               class="form-control" 
                               id="map" 
                               name="map" 
                               placeholder="@lang('admin.contact_us.create.map_placeholder')" 
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
                                        @lang('admin.contact_us.show.address') ({{ strtoupper($locale) }})
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="address_{{ $locale }}" 
                                           name="address[{{ $locale }}]" 
                                           placeholder="@lang('admin.contact_us.create.address_placeholder', ['locale' => $locale])"
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
                            <i class="ft-x"></i> @lang('admin.contact_us.create.cancel')
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check-square-o"></i> @lang('admin.contact_us.create.submit')
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection