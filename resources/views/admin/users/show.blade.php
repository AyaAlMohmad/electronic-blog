@extends('layouts.app')
@section('content')

<div class="col-xl-8 col-lg-10 mx-auto">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('admin.users.show.title', ['id' => $user->id])</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row mt-2">
                    <div class="col-md-6">
                        <h5>@lang('admin.users.show.name')</h5>
                        <p>{{ $user->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>@lang('admin.users.show.email')</h5>
                        <p><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                    </div>
                </div>
                
                <div class="row mt-2">
                    <div class="col-md-6">
                        <h5>@lang('admin.users.show.image')</h5>
                        <img src="{{ $user->image_path }}" alt="{{ $user->name }}" width="100">
                    </div>
                </div>
                
                <div class="form-actions right mt-3">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary">
                        <i class="ft-arrow-left"></i> @lang('admin.users.show.back_button')
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection