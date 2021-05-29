@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
    <div class="row justify-content-center">
        <div class="alert alert-success"> {{session('success')}}</div>
    </div>
    @endif

    @if(session('failed'))
    <div class="row justify-content-center">
        <div class="alert alert-danger"> {{session('failed')}}</div>
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('notification.title')</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('notification.notify') }}">
                        @csrf
                        <div class="form-group">
                            <label for="users">@lang('notification.select_user')</label>
                            <select class="form-control" id="users" name="user">
                                @foreach ($users as  $user)
                                    <option  value="{{ $user->id }}">{{ $user->name}}</option>
                                @endforeach
                            </select>
                            @error('user')
                            <div class="alert alert-danger my-1" role="alert">
                                    {{ $message }}
                              </div>
                            @enderror                     
                        </div>
                        <div class="form-group">
                            <label for="email_type">@lang('notification.notify_type')</label>
                            <select class="form-control" id="email_type" name="email_type">
                                @foreach ($email_types as  $key=>$notify)
                                    <option value="{{ $key }}">{{ $notify }}</option>
                                @endforeach
                            </select>
                            @error('email_type')
                            <div class="alert alert-danger my-1" role="alert">
                                {{ $message }}
                          </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="message">@lang("notification.message")</label>
                            <textarea class="form-control" id="message" rows="3" name="message"></textarea>
                          </div>
                        @error('message')
                            <div class="alert alert-danger my-1" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('notification.notify')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
