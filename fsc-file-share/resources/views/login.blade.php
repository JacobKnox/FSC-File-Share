<x-template pageName="Login">
    <form method="POST" action="/login">
        @csrf

        <div>
            <label for="username" class="form-label" value="{{old('username')}}">Username</label>
            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror">
            @error('username')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Login</button>
        @error('credentials')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </form>
</x-template>