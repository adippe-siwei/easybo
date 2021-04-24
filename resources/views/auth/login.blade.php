@extends('layouts.logout')

@section('content')


<form method="POST" action="{{ route('login') }}" class="form-signin">
    @csrf
    <h1>{{ config('app.name', 'Siwei') }}</h1>
    <h5 class="h5 mb-3 font-weight-normal">{{__('auth.titlePleaseSignIn')}}</h5>

    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required
        autocomplete="{{__('auth.labelEmail')}}" autofocus placeholder="Email">

    <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password"
        placeholder="{{__('auth.labelPassword')}}">

    <button class="btn btn-lg btn-primary btn-block" type="submit">
        <i class="icofont-ui-password"></i>
        {{__('auth.btnSignIn')}}
    </button>
    <p class="mt-5 mb-3 text-muted">&copy; <a href="http://www.siwei.fr">SIWEI</a></p>
</form>
@stop
