<div class="col gx-3">
    <div class="card mx-auto mb-2 h-100">
        <div class="card-body">
            <h5 class="card-title text-center"><a href="/files/{{$file->id}}" class="card-link">{{$file->title}}</a></h5>
            <h6 class="card-subtitle mb-2 text-muted text-capitalize">{{$file->tags ? implode(', ', $file->tags) : ''}}</h6>
            <p class="card-text">{{$file->description}}</p>
            @if($file->user_id != $auth_user?->id && $file->user == null)
                <p class="card-text">Uploaded by Deleted User</p>
            @else
                @if($file->user_id == $auth_user?->id)
                    <p class="card-text">Uploaded by <a href="/users/{{$auth_user->id}}" class="card-link">{{$auth_user->name}}</a></p>
                @else
                    @php($owner = $file->user)
                    <p class="card-text">Uploaded by <a href="/users/{{$owner->id}}" class="card-link">{{$owner->name}}</a></p>
                @endif
            @endif
        </div>
    </div>
</div>