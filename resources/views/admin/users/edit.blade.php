@extends('layouts.app')
@section('content')
<div class="col-xl-8 col-lg-10 mx-auto">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('admin.users.edit.title')</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    
                    <!-- Basic Information Section -->
                    <div class="form-group">
                        <label for="name">@lang('admin.users.edit.name')</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="email">@lang('admin.users.edit.email')</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- User Image -->
                    <div class="form-group">
                        <label for="image">@lang('admin.users.edit.image')</label>
                        @if($user->image_path)
                            <div class="mb-2">
                                <img src="{{ $user->image_path }}" 
                                     alt="{{ $user->name }}" 
                                     class="img-thumbnail" 
                                     width="100">
                            </div>
                        @endif
                        <input type="file" class="form-control" id="image" name="image">
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Permissions Section -->
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="is_admin" 
                                   name="is_admin" value="1" 
                                   {{ $user->is_admin ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_admin">@lang('admin.users.edit.is_admin')</label>
                        </div>
                        @error('is_admin')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="is_writer" 
                                   name="is_writer" value="1" 
                                   {{ $user->is_writer ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_writer">@lang('admin.users.edit.is_writer')</label>
                        </div>
                        @error('is_writer')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-actions right mt-3">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-warning mr-1">
                            <i class="ft-x"></i> @lang('admin.users.edit.cancel')
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check-square-o"></i> @lang('admin.users.edit.submit')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection