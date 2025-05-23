@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Approve Writer: {{ $user->name }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.writers.approve', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Current User Info</label>
                            <div class="form-control-plaintext">
                                <p><strong>Name:</strong> {{ $user->name }}</p>
                                <p><strong>Email:</strong> {{ $user->email }}</p>
                                @if($user->image_path)
                                    <img src="{{  $user->image_path }}" width="100" class="img-thumbnail mt-2">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bio">Biography*</label>
                            <textarea name="bio" id="bio" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="subsection_id">Subsection*</label>
                            <select name="subsection_id" id="subsection_id" class="form-control" required>
                                <option value="">Select Subsection</option>
                                @foreach($subsections as $subsection)
                                <option value="{{ $subsection->id }}">{{ $subsection->getTranslation('name', app()->getLocale()) }}->{{ $subsection->section->getTranslation('name', app()->getLocale()) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="image">Profile Image</label>
                            <input type="file" name="image" id="image" class="form-control-file">
                            <small class="form-text text-muted">Leave empty to use current profile image</small>
                        </div>
                    </div>
                </div>

                <div class="form-group text-right mt-4">
                    <a href="{{ route('admin.writers.pending') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i> Approve Writer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection