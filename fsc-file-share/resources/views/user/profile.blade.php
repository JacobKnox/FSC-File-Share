<x-template pageName="{{$user->username}} Profile">
    <p>{{$user->name}}</p>
    <p>{{$user->username}}</p>
    <p>Files Uploaded</p>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2">
            @foreach($user->files as $file)
                <div class="col align-self-center my-3">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title text-center"><a href="/files/{{$file->id}}" class="card-link">{{$file->title}}</a></h5>
                            <h6 class="card-subtitle mb-2 text-muted text-capitalize">{{implode(', ', $file->tags())}}</h6>
                            <p class="card-text">{{$file->description}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <p>Comments Left</p>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2">
            @foreach($user->comments as $comment)
                <div class="col align-self-center my-3">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            @if($comment->file == null)
                                <p>Deleted File</p>
                            @else
                                <h5 class="card-title text-center"><a href="/files/{{$comment->file->id}}" class="card-link">{{$comment->file->title}}</a></h5>
                            @endif
                            <p class="card-text">{{$comment->content}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @if(Auth::user()->id == $user->id)
        <p>Liked Files</p>
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2">
                @foreach($user->likes as $like)
                    <div class="col align-self-center my-3">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                @if($like->file == null)
                                    <p>Deleted File</p>
                                @else
                                    <h5 class="card-title text-center"><a href="/files/{{$like->file->id}}" class="card-link">{{$like->file->title}}</a></h5>
                                    <p class="card-text">{{$like->file->description}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
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