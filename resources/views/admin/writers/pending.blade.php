@extends('layouts.app')

@section('content')
    <section id="configuration">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Pending Writer Requests</h4>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                                <li>
                                    <a href="{{ route('admin.writers.approved') }}" class="btn btn-sm btn-primary">
                                        <i class="ft-user"></i> Approved Writers
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Profile</th>
                                        <th style="width: 120px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pendingWriters as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if ($user->image_path)
                                                    <img src="{{  $user->image_path }}" width="50"
                                                        class="rounded-circle">
                                                @else
                                                    <span class="badge badge-light">No Image</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.writers.approve-form', $user->id) }}"
                                                    class="btn btn-sm btn-outline-success" title="Approve">
                                                    <i class="fas fa-check"></i> 
                                                </a>
                                                <form action="{{ route('admin.writers.reject', $user->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Are you sure?')" title="Reject">
                                                        <i class="fas fa-times"></i> 
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No pending writer requests</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
