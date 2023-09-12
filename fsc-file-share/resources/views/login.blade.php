<x-template pageName="Login">
    <div class="row justify-content-center">
        <form method="POST" action="/login" class="text-center col-6">
            @csrf
            <div class="row justify-content-center mb-2">
                <div class="col-8">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}">
                    @error('username')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>   
            </div>
            <div class="row justify-content-center mb-2">
                <div class="col-8">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <button type="submit" class="btn btn-success">Login</button>
            @error('credentials')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </form>
    </div>
    
</x-template>