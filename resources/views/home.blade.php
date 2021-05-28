@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Avatar</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Warning!</strong>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td><img src="avatars/{{ $user->avatar }}" style="width:80px; height:80px;"</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#exampleModal{{ $user->id }}">
                                            Change avatar
                                        </button>
                                        <div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1"
                                             role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form enctype="multipart/form-data"
                                                          action="{{ route('upload.avatar', $user->id) }}"
                                                          method="post">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Change
                                                                avatar</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" name="avatar"
                                                                           class="custom-file-input"
                                                                           id="inputGroupFile04">
                                                                    <label class="custom-file-label"
                                                                           for="inputGroupFile04">Choose
                                                                        avatar...</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">Save changes
                                                            </button>

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
