@extends('_layouts.auth')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form class="vstack gap-3" action="{{ route('login.handle') }}" method="POST">
        @csrf
        <div>
            <label class="form-label" id="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required autofocus>
        </div>
        <div>
            <label class="form-label" id="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
@endsection