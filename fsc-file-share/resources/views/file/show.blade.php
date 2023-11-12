<x-template pageName="{{$file->title}}">
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2">
            <div class="col">
                <a href="/files/{{$file->id}}/preview">Preview</a>
            </div>
            <div class="col text-center">
                <p class="my-1 fs-4 fw-bold">{{$file->title}}</p>
                @if($file->tags())
                    @foreach($file->tags() as $tag)
                        <form method="POST" action="/files" class="inline">
                            @csrf
                            <input type="hidden" name="tags[]" id="tags" class="form-control" value="{{$tag}}">
                            <button type="submit" class="btn">{{$tag}}</button>
                        </form>
                    @endforeach
                @endif
                {{-- <p class="my-1 fs-6 text-muted text-capitalize">{{implode(', ', $file->tags())}}</p> --}}
                @if(!isset($file->user))
                    <p class="my-1 fs-6">Uploaded by Deleted User</p>
                @else
                    <p class="my-1 fs-6">Uploaded by <a href="/users/{{$file->user->id}}" class="text-decoration-none link-primary">{{$file->user->name}}</a></p>
                @endif
                <p class="my-1 fs-6">{{$file->description}}</p>
                <div class="container">
                    <div class="row row-cols-2 row-cols-sm-3 justify-content-center">
                        <div class="col">
                            @if($file->likes && $user != null)
                                @if($user->checkLike($file->id))
                                    <a href="/files/{{$file->id}}/unlike/id={{$user->id}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-hand-thumbs-up-fill text-primary my-4" viewBox="0 0 16 16">
                                            <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"/>
                                        </svg>
                                    </a>
                                @else
                                    <a href="/files/{{$file->id}}/like/id={{$user->id}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-hand-thumbs-up text-primary my-4" viewBox="0 0 16 16">
                                            <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                                        </svg>
                                    </a>
                                @endif
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-hand-thumbs-up text-muted my-4" viewBox="0 0 16 16">
                                    <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                                </svg>
                            @endif
                        </div>
                        <div class="col">
                            @if($file->comments && $user != null)
                                <button class="btn py-0 px-0" type="button" data-bs-toggle="collapse" data-bs-target="#commentForm" aria-controls="commentForm" aria-expanded="false" aria-label="Toggle comment form">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-chat-left-text text-primary my-4" viewBox="0 0 16 16">
                                        <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                        <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                    </svg>
                                </button>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-chat-left-text text-muted my-4" viewBox="0 0 16 16">
                                    <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                    <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                            @endif
                        </div>
                        <div class="col">
                            @if($file->downloads && $user != null)
                                <a href="/files/{{$file->id}}/download">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-download my-4 text-primary" viewBox="0 0 16 16">
                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                    </svg>
                                </a>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-download my-4 text-muted" viewBox="0 0 16 16">
                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                </svg>
                            @endif
                        </div>
                        @if($user?->id == $file->user?->id)
                            <div class="col">
                                <button type="button" class="btn p-0 mt-4 mt-sm-0 mb-4" data-bs-toggle="modal" data-bs-target="#updateModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-pencil text-success" viewBox="0 0 16 16">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn p-0 mb-4" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-trash text-danger" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                    </svg>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="container">
                    <div class="border-top border-black border-2 pt-2">
                        @if($user != null)
                            <div class="collapse" id="commentForm">
                                <form action="/files/{{$file->id}}/comments/{{$user->id}}" method="POST">
                                    @csrf
                                    <x-formrow col='12'>
                                        <x-asterisk></x-asterisk>
                                        <textarea name="content" id="content" class="form-control" cols="55" rows="5"></textarea>
                                    </x-formrow>
                                    <button type="submit" class="btn btn-success">Comment</button>
                                </form>
                            </div>
                        @endif
                        @if($file->getComments->isEmpty())
                            @if($file->comments)
                                <p class="pt-2">Looks like there aren't any comments right now.<br>Be the first to comment on this file.</p>
                            @else
                                <p class="text-muted pt-2">Comments are turned off for this file.</p>
                            @endif
                        @else
                            <div class="row row-cols-1 text-start">
                                @foreach($file->getComments as $comment)
                                    <div class='col container'>
                                        <div class="row row-cols-2">
                                            <div class="col">
                                                @if($comment->user != null)
                                                    <a href="/users/{{$comment->user->id}}">{{$comment->user->name}}</a>
                                                @else
                                                    <p class="m-0">Deleted User</p>
                                                @endif
                                            </div>
                                            @if($user?->id == $comment->user?->id)
                                                <div class="col text-end">
                                                    <button class="btn py-0 px-0" id="commentUpdate{{$comment->id}}Btn" type="button" data-bs-toggle="collapse" data-bs-target="#commentUpdateForm" aria-controls="commentUpdateForm" aria-expanded="false" aria-label="Toggle comment update form">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                                            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                        @if($user?->id == $comment->user?->id)
                                            <div class="collapse container" id="commentUpdateForm">
                                                <div class="row align-items-end">
                                                    <div class="col px-0">
                                                        <form action="/files/comments/{{$comment->id}}" method="POST">
                                                            @csrf
                                                            @method("PUT")
                                                            <x-formrow align='start' col='12'>
                                                                <x-asterisk></x-asterisk>
                                                                <textarea name="content" id="content" class="form-control" cols="55" rows="5">{{$comment->content}}</textarea>
                                                            </x-formrow>
                                                            <button type="submit" class="btn btn-success">Update</button>
                                                        </form>
                                                    </div>
                                                    <div class="col-3 px-0 text-end">
                                                        <form action="/files/comments/{{$comment->id}}" method="POST">
                                                            @method("DELETE")
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <p id="comment{{$comment->id}}" class='d-block'>{{$comment->content}}</p>
                                    </div>
                                    <script>
                                        var content = document.getElementById('comment' + {!! $comment->id !!});
                                        var btn = document.getElementById('commentUpdate' + {!! $comment->id !!} + 'Btn');
                                        btn.addEventListener("click", function () {
                                            if(content.classList.contains('d-block')) {
                                                content.classList.remove('d-block');
                                                content.classList.add('d-none');
                                            }
                                            else{
                                                content.classList.remove('d-none');
                                                content.classList.add('d-block');
                                            }
                                        });
                                    </script>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-template>

<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <form action="/files/{{$file->id}}" method="POST">
        @method("PUT")
        @csrf
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <x-formrow>
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ $file->title }}">
                </x-formrow>
                <x-formrow>
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror">{{ $file->description }}</textarea>
                </x-formrow>
                <x-formrow>
                    <input type="checkbox" name="downloads" id="downloads" {{ $file->downloads == 1 ? 'checked' : '' }}>
                    <label for="downloads" class="form-label">Allow file downloads.</label>
                </x-formrow>
                <x-formrow>
                    <input type="checkbox" name="comments" id="comments" {{ $file->comments == 1 ? 'checked' : '' }}>
                    <label for="comments" class="form-label">Allow file comments.</label>
                </x-formrow>
                <x-formrow>
                    <input type="checkbox" name="likes" id="likes" {{ $file->likes == 1 ? 'checked' : '' }}>
                    <label for="likes" class="form-label">Allow file likes.</label>
                </x-formrow>
                <x-formrow>
                    <label for="tags[]" class="form-label">Tags</label>
                    <select name="tags[]" id="tags" class="form-control" multiple>
                        @foreach(config('misc.tags') as $tag)
                            <option value="{{$tag}}" @if($file->tags() != null && in_array($tag, $file->tags())) selected @endif>{{ucwords($tag)}}</option>
                        @endforeach
                    </select>
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
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Confirm File Delete</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this file?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <form action="/files/{{$file->id}}" method="POST">
            @method("DELETE")
            @csrf
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
</div>