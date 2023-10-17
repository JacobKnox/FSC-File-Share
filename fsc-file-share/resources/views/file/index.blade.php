<x-template pageName="Files">
    <div class="container">
        <div class="row align-items-start">
            <div class="col me-auto">
                <form action="/files" method="POST">
                    @csrf
                    <div class="row align-items-center">
                        <div class="col-3">
                            <label for="tags[]" class="form-label">Tags</label>
                        </div>
                        <div class="col-3">
                            <label for="title" class="form-label">Title Contains</label>
                        </div>
                        <div class="col-3">
                            <label for="description" class="form-label">Description Contains</label>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-success px-3 py-2">Search</button>
                        </div>
                    </div>
                    <div class="row align-items-start">
                        <div class="col-3">
                            <select name="tags[]" id="tags" class="form-control" multiple>
                                @foreach(config('misc.tags') as $tag)
                                    <option value="{{$tag}}" @if(old('tags') != null && in_array($tag, old('tags'))) selected @endif>{{ucwords($tag)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                        </div>
                        <div class="col-3">
                            <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}">
                        </div>
                        <div class="col-auto">
                            <a href="/files" class="btn btn-danger px-3 py-2 align-self-center">Reset</a>
                        </div>
                    </div>
                </form>
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