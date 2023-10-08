<x-template pageName="Files">
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2">
            @foreach($files as $file)
                <div class="col align-self-center my-3">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title text-center"><a href="/files/{{$file->id}}" class="card-link">{{$file->title}}</a></h5>
                            <h6 class="card-subtitle mb-2 text-muted text-capitalize">{{implode(', ', $file->tags())}}</h6>
                            <p class="card-text">{{$file->description}}</p>
                            @if(!isset($user))
                                <p class="card-text">Uploaded by Deleted User</p>
                            @else
                                <p class="card-text">Uploaded by <a href="/users/{{$file->user->id}}" class="card-link">{{$file->user->name}}</a></p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-template>