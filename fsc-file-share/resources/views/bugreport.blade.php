<x-template pageName="Bug Report">
    <div class="row justify-content-center">
        <form method="POST" action="/bug" class="text-center col-10">
            @csrf
            <div class="row justify-content-center mb-2 text-start">
                <div class="col-8">
                    <label for="intended" class="form-label"><x-asterisk></x-asterisk> Intended Action</label>
                    <textarea name="intended" id="intended" class="form-control @error('intended') is-invalid @enderror" value="{{ old('intended') }}" placeholder="Enter what you were trying to do in as much detail as possible."></textarea>
                    @error('intended')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>   
            </div>
            <div class="row justify-content-center mb-2 text-start">
                <div class="col-8">
                    <label for="actual" class="form-label"><x-asterisk></x-asterisk> Actual Action</label>
                    <textarea name="actual" id="actual" class="form-control @error('actual') is-invalid @enderror" value="{{ old('actual') }}" placeholder="Enter what actually happened in as much detail as possible."></textarea>
                    @error('actual')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>  
            </div>
            <div class="row justify-content-center mb-2 text-start">
                <div class="col-8">
                    <label for="page" class="form-label"><x-asterisk></x-asterisk> Page</label>
                    <input type="url" name="page" id="page" class="form-control @error('page') is-invalid @enderror" value="{{ old('page') }}" placeholder="URL of page where bug happened">
                    @error('page')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>  
            </div>
            <div class="row justify-content-center mb-2 text-start">
                <div class="col-8">
                    <label for="image" class="form-label">Screenshot</label>
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}">
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>  
            </div>
            <div class="row justify-content-center mb-2 text-start">
                <div class="col-8">
                    <label for="other" class="form-label">Other Comments</label>
                    <textarea name="other" id="other" class="form-control @error('other') is-invalid @enderror" value="{{ old('other') }}" placeholder="Please enter any other comments you think may be helpful. Be as detailed as possible."></textarea>
                    @error('other')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>  
            </div>
            
            <button type="submit" class="btn btn-success">Submit</button>
            @error('credentials')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </form>
    </div>
</x-template>