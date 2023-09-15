<x-template pageName="{{$user->username}} Profile">
    @if(Auth::user() == $user)
        <form method="POST" action="/user/{{$user->id}}">
            @method('DELETE')
            @csrf

            <button type="submit" class="btn btn-danger">Delete Account</button>
        </form>
    @endif
</x-template>