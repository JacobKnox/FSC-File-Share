<x-template pageName="Files">
    <div class="container">
        <div class="row">
            <div class="col col-2 me-auto">

            </div>
            <div class="col col-auto pe-0">
                <a href="/files/create" class="btn btn-success px-3 py-2 align-self-center">Create</a>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 gy-3 mt-3">
            @foreach($files as $file)
                <div class="col gx-3">
                    <div class="card mx-auto h-100">
                        <div class="card-body">
                            <h5 class="card-title text-center"><a href="/files/{{$file->id}}" class="card-link">{{$file->title}}</a></h5>
                            <h6 class="card-subtitle mb-2 text-muted text-capitalize">{{implode(', ', $file->tags())}}</h6>
                            <p class="card-text">{{$file->description}}</p>
                            @if($file->user == null)
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