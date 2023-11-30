<x-template pageName="Settings">
    <p class="text-center fw-bold fs-3 mb-0">Update Account/Profile Information</p>
    <form action="/users/{{$user->id}}" method="POST">
        @method("PUT")
        @csrf
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
        <x-formrow>
            <button type="submit" class="btn btn-success">Update</button>
        </x-formrow>
    </form>
    <p class="text-center fw-bold fs-3 mb-0">Change Password</p>
    <form action="/users/{{$user->id}}/password" method="POST">
        @csrf
        @method("PUT")
        <x-formrow>
            <label for="password" class="form-label"><x-asterisk></x-asterisk> Current Password</label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </x-formrow>
        <x-formrow>
            <label for="npassword" class="form-label"><x-asterisk></x-asterisk> New Password</label>
            <input type="password" name="npassword" id="npassword" class="form-control @error('npassword') is-invalid @enderror">
            @error('npassword')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </x-formrow>
        <x-formrow>
            <label for="cpassword" class="form-label"><x-asterisk></x-asterisk> Confirm Password</label>
            <input type="password" name="cpassword" id="cpassword" class="form-control @error('cpassword') is-invalid @enderror">
            @error('cpassword')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </x-formrow>
        <x-formrow>
            <button type="submit" class="btn btn-danger">Change</button>
        </x-formrow>
    </form>
    <p class="text-center fw-bold fs-3 mb-0">Default File Settings</p>
    <p class="text-center">These are the default settings that will be applied when you create a new file. You can change them for each individual file.</p>
    <p class="text-center text-danger">This feature does not currently work.</p>
    <form action="/users/{{$user->id}}" method="POST">
        @csrf
        @method("PUT")
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
            <button type="submit" class="btn btn-success">Update</button>
        </x-formrow>
    </form>
    <p class="text-center fw-bold fs-3 mb-0">Notification Settings</p>
    <p class="text-center text-danger">This feature does not currently work.</p>
    <form action="/users/{{$user->id}}" method="POST">
        @csrf
        @method("PUT")
        <x-formrow>
            <input type="checkbox" name="likes" id="likes" {{ old('likes') != null ? 'checked' : '' }}>
            <label for="likes" class="form-label">Likes on my files.</label>
            @error('likes')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </x-formrow>
        <x-formrow>
            <input type="checkbox" name="comments" id="comments" {{ old('comments') != null ? 'checked' : '' }}>
            <label for="comments" class="form-label">Comments on my files.</label>
            @error('comments')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </x-formrow>
        <x-formrow>
            <button type="submit" class="btn btn-success">Update</button>
        </x-formrow>
    </form>
</x-template>