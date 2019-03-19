@extends('app')
@section('content')
    @if(isset($error_message))
        <h3 style="color:red">{{ $error_message }}</h3>
    @endif
    <h1>Password Reset Required</h1>

    <h4>IT has instituted a password policy on this application.  All passwords now require the following attributes:</h4>
    <ul>
        <li>8 character minimum</li>
        <li>1 uppercase letter (minimum)</li>
        <li>1 lowercase letter (minimum)</li>
        <li>1 number letter (minimum)</li>
        <li>1 special character (minimum) (eg:  $%^&*@#{})</li>
    </ul>

    <h4>Please create a new password:</h4>
    <form method="POST" action="/password_policy_reset" accept-charset="UTF-8">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="password">Password:</label>
            <input name="password" type="password" value="" id="password">
        </div>

        <div class="form-group">
            <label for="password_confirm">Password_confirm:</label>
            <input name="password_confirm" type="password" value="" id="password_confirm">
        </div>

        <input class="btn btn-info" type="submit" value="Update Password">
    </form>
@stop
@section('scripts')
@stop