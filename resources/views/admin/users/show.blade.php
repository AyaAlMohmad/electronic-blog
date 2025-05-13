@extends('layouts.app')
@section('content')

<div class="col-xl-8 col-lg-10 mx-auto">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ __('user Details') }}  {{ $user->id }}</h4>
        </div>
        <div class="card-content">
            <div class="card-body">

                
                <div class="row mt-2">
           
                    <div class="col-md-6">
                        <h5>{{ __('Name') }} </h5>
                        <p>{{ $user->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>{{ __('Email') }} </h5>
                        <p><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                    </div>
        
                </div>
                
                <div class="row mt-2">
                    <div class="col-md-6">
                        <h5>{{ __('Image') }}</h5>
                        <img src="{{   $user->image_path }}" alt="{{ $user->name }}" width="100">
                    </div>
                </div>
                <div class="form-actions right mt-3">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary">
                        <i class="ft-arrow-left"></i> {{ __('Back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection