<x-template pageName="{{$user->username}} Profile">
    <div class="container">
        <p>{{$user->name}}</p>
        <p>{{$user->username}}</p>
        <p class="text-center fw-bold fs-3 mb-0">Files Uploaded</p>
        <div class="row justify-content-center row-cols-1 row-cols-md-2">
            @each('components.cards.file', $user->files, 'file', 'components.empties.file')
        </div>
        <p class="text-center fw-bold fs-3 mb-0">Comments Left</p>
        @if(!$user->comments->isEmpty())
            <div class="row justify-content-center row-cols-1 row-cols-md-2">
                @foreach($user->comments as $comment)
                    <div class="col my-3">
                        <div class="card mx-auto" style="width: 18rem;">
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
        @else
            <p class="text-center mt-3 mb-5">This user has not left any comments yet.</p>
        @endif
        @if(Auth::user()->id == $user->id)
            <p class="text-center fw-bold fs-3 mb-0">Liked Files</p>
            @if(!$user->likes->isEmpty())
                <div class="row justify-content-center row-cols-1 row-cols-md-2">
                    @foreach($user->likes as $like)
                        <div class="col my-3">
                            <div class="card mx-auto" style="width: 18rem;">
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
            @else
                <p class="text-center mt-3 mb-5">This user has not liked any files yet.</p>
            @endif
            <div class="row text-center row-cols-1 mt-5">
                <div class="col">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#updateModal">Update Account</button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete Account</button>
                </div>
            </div>
        @endif

        <a href="/report/user/{{$user->id}}" class="btn btn-danger">Report</a>
    </div>
</x-template>

<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <form action="/users/{{$user->id}}" method="POST">
        @method("PUT")
        @csrf
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <x-formrow>
                    <label for="status" class="form-label"><x-asterisk></x-asterisk> Status</label>
                    <select name="status" id="status" class="form-control" disabled>
                        <option value="student" {{ $user->status == 'student' ? "selected" : "" }}>Student</option>
                        <option value="faculty" {{ $user->status == 'faculty' ? "selected" : "" }}>Faculty</option>
                    </select>
                </x-formrow>
                <x-formrow>
                    <label for="name" class="form-label"><x-asterisk></x-asterisk> Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </x-formrow>
                <x-formrow>
                    <label for="sid" class="form-label"><x-asterisk></x-asterisk> ID Number</label>
                    <input type="text" name="sid" id="sid" class="form-control" value="{{ $user->sid }}" disabled>
                </x-formrow>
                <x-formrow>
                    <label for="username" class="form-label"><x-asterisk></x-asterisk> Desired Username</label>
                    <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ $user->username }}">
                    @error('username')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </x-formrow>
                <x-formrow>
                    <label for="email" class="form-label"><x-asterisk></x-asterisk> School Email</label>
                    <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}" disabled>
                </x-formrow>
                <x-formrow>
                    <label for="pemail" class="form-label">Personal Email</label>
                    <input type="text" name="pemail" id="pemail" class="form-control @error('pemail') is-invalid @enderror" value="{{ $user->pemail }}">
                    @error('pemail')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </x-formrow>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </div>
        </div>
    </form>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <form action="/users/{{$user->id}}" method="POST">
        @method("DELETE")
        @csrf
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Confirm Account Delete</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <x-formrow>
                    <input type="checkbox" name="files" id="files" {{ old('files') != null ? 'checked' : '' }}>
                    <label for="files" class="form-label">Delete all of my files.</label>
                </x-formrow>
                <x-formrow>
                    <input type="checkbox" name="likes" id="likes" {{ old('likes') != null ? 'checked' : '' }}>
                    <label for="likes" class="form-label">Delete all of my likes.</label>
                </x-formrow>
                <x-formrow>
                    <input type="checkbox" name="comments" id="comments" {{ old('comments') != null ? 'checked' : '' }}>
                    <label for="comments" class="form-label">Delete all of my comments.</label>
                </x-formrow>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </div>
        </div>
    </form>
</div>