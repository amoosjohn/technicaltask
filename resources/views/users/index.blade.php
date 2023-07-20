@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card" style="margin-top:10px;">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session('system_error'))
                            <div class="alert alert-error" role="alert">
                                {{ session('system_error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        

                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf
                        
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right required">{{ __('Name') }}</label>
                        
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        
                                    @error('name')
                                    <span class="invalid-feedback display-show" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        
                        
                        
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right required">{{ __('Email') }}</label>
                        
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        
                                    @error('email')
                                    <span class="invalid-feedback display-show" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right required">{{ __('Password') }}</label>
                        
                                <div class="col-md-6">
                                    <input id="name" type="password" class="form-control @error('name') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>
                        
                                    @error('password')
                                    <span class="invalid-feedback display-show" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="interest" class="col-md-4 col-form-label text-md-right required">{{ __('Interest') }}</label>
                        
                                <div class="col-md-6">
                                    @foreach($interests as $interest)
                                        <div style="margin-right:10px">
                                            <input type="checkbox" id="{{$interest}}" value="{{ $interest }}" name="interest[]" class="@error('interest') is-invalid @enderror" />
                                            <label for="{{$interest}}">{{$interest}}</label>
                                        </div>
                                    @endforeach
                        
                                    @error('interest')
                                    <span class="invalid-feedback display-show" role="alert" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
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