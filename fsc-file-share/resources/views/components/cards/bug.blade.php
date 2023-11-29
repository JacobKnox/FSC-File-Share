<div class="col gx-3 mb-3">
    <div class="card mx-auto h-100">
        <div class="card-body">
            <p><strong>Category:</strong> {{$bug->category}}</p>
            <p><strong>Intended Action:</strong> {{$bug->intended}}</p>
            <p><strong>Actual Action:</strong> {{$bug->actual}}</p>
            <p><strong>Page:</strong> <a href="{{$bug->page}}">{{$bug->page}}</a></p>
            <p class="mb-0"><strong>Other Comments:</strong> {{$bug->other ? $bug->other : "None provided"}}</p>
        </div>
        <div class="card-footer p-1 m-auto w-100 row">
            <form action="/bugs/{{$bug->id}}/push" method="POST" class="col p-1 text-center">
                @csrf
                @method("PUT")
                <button type="submit" class="btn btn-success w-100">Push</button>
            </form>
            <div class="col p-1">
                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#editModal">
                    Edit
                </button>
            </div>
            <form action="/bugs/{{$bug->id}}/delete" method="POST" class="col p-1 text-center">
                @csrf
                @method("DELETE")
                <button type="submit" class="btn btn-danger w-100">Delete</button>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <form action="/bugs/{{$bug->id}}/edit" method="POST">
        @method("PUT")
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Bug Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="{{ config('styles.formRow') }}">
                        <div class="col-8">
                            <label for="category" class="form-label"><x-asterisk></x-asterisk> Bug Category</label>
                            <select name="category" id="category" class="form-control">
                                <option value="select" {{ $bug->category == null ? "selected" : "" }} disabled>Select a category:</option>
                                <option value="text-error" {{ $bug->category == 'text-error' ? "selected" : "" }}>Misspelling/Grammer</option>
                                <option value="visual" {{ $bug->category == 'visual' ? "selected" : "" }}>Visual/Image</option>
                                <option value="security" {{ $bug->category == 'security' ? "selected" : "" }}>Security Vulnerability</option>
                                <option value="other" {{ $bug->category == 'other' ? "selected" : "" }}>Other</option>
                            </select>
                            @error('category')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>   
                    </div>
                    <div class="{{ config('styles.formRow') }}">
                        <div class="col-8">
                            <label for="intended" class="form-label"><x-asterisk></x-asterisk> Intended Action</label>
                            <textarea name="intended" id="intended" class="form-control @error('intended') is-invalid @enderror" placeholder="Enter what you were trying to do in as much detail as possible.">{{ $bug->intended }}</textarea>
                            @error('intended')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>   
                    </div>
                    <div class="{{ config('styles.formRow') }}">
                        <div class="col-8">
                            <label for="actual" class="form-label"><x-asterisk></x-asterisk> Actual Action</label>
                            <textarea name="actual" id="actual" class="form-control @error('actual') is-invalid @enderror" placeholder="Enter what actually happened in as much detail as possible.">{{ $bug->actual }}</textarea>
                            @error('actual')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>  
                    </div>
                    <div class="{{ config('styles.formRow') }}">
                        <div class="col-8">
                            <label for="page" class="form-label"><x-asterisk></x-asterisk> Page</label>
                            <input type="text" name="page" id="page" class="form-control @error('page') is-invalid @enderror" value="{{ $bug->page }}" placeholder="URL of page where bug happened">
                            @error('page')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>  
                    </div>
                    <div class="{{ config('styles.formRow') }}">
                        <div class="col-8">
                            <label for="other" class="form-label">Other Comments</label>
                            <textarea name="other" id="other" class="form-control @error('other') is-invalid @enderror" placeholder="Please enter any other comments you think may be helpful. Be as detailed as possible.">{{ $bug->other }}</textarea>
                            @error('other')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>  
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>