<div class="col gx-3">
    <div class="card mx-auto mb-2 h-100">
        <div class="card-body">
            <h5 class="card-title text-center"><a href="/files/{{$file->id}}" class="card-link">{{$file->title}}</a></h5>
            <h6 class="card-subtitle mb-2 text-muted text-capitalize">{{$file->tags() ? implode(', ', $file->tags()) : ''}}</h6>
            <p class="card-text">{{$file->description}}</p>
            @if($file->user == null)
                <p class="card-text">Uploaded by Deleted User</p>
            @else
                <p class="card-text">Uploaded by <a href="/users/{{$file->user->id}}" class="card-link">{{$file->user->name}}</a></p>
            @endif
        </div>
    </div>
</div>