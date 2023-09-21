<x-template pageName="File Upload">
    <div class="row justify-content-center">
        <form method="POST" action='/file/create' class="text-center col-10" enctype="multipart/form-data">
            @csrf
            <x-formrow>
                <label for="title" class="form-label"><x-asterisk></x-asterisk> Title</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </x-formrow>
            <x-formrow>
                <label for="description" class="form-label"><x-asterisk></x-asterisk> Description</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </x-formrow>
            <x-formrow>
                <label for="file" class="form-label"><x-asterisk></x-asterisk> File</label>
                <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror" value="{{ old('file') }}">
                @error('file')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </x-formrow>
            <x-formrow>
                <input type="checkbox" name="downloads" id="downloads" {{ old('downloads') != null ? 'checked' : '' }}>
                <label for="downloads" class="form-label">Allow file downloads.</label>
                @error('downloads')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </x-formrow>
            <x-formrow>
                <input type="checkbox" name="comments" id="comments" {{ old('comments') != null ? 'checked' : '' }}>
                <label for="comments" class="form-label">Allow file comments.</label>
                @error('comments')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </x-formrow>
            <x-formrow>
                <input type="checkbox" name="likes" id="likes" {{ old('likes') != null ? 'checked' : '' }}>
                <label for="likes" class="form-label">Allow file likes.</label>
                @error('likes')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </x-formrow>
            <x-formrow>
                <label for="tags" class="form-label">Tags</label>
                <select name="tags" id="tags" class="form-control" multiple>

                </select>
            </x-formrow>
            <x-formrow>
                <x-asterisk></x-asterisk>
                <input type="checkbox" name="plagiarism" id="plagiarism" {{ old('plagiarism') != null ? 'checked' : '' }}>
                <label for="plagiarism" class="form-label"> I agree not to actively participate in or facilitate plagiarism.</label>
                @error('plagiarism')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </x-formrow>

            <button type="submit" class="btn btn-success">Upload</button>
        </form>
    </div>
</x-template>