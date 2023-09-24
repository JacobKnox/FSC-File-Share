<x-template pageName="{{$user->username}} Profile">
    @if(Auth::user() == $user)
        <form method="POST" action="/users/{{$user->id}}">
            @method('DELETE')
            @csrf

            <button type="submit" class="btn btn-danger">Delete Account</button>
        </form>
        
        <form method="POST" action="/users/{{$user->id}}">
            @method('PUT')
            @csrf
            <x-formrow>
                <label for="name" class="form-label"><x-asterisk></x-asterisk> Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </x-formrow>
            <button type="submit" class="btn btn-danger">Update</button>
        </form>
    @endif
</x-template>