<x-template pageName="Sign Up">
    <div class="row justify-content-center">
        <form method="POST" action="/signup" class="text-center col-10">
            @csrf
            <x-formrow>
                <label for="status" class="form-label"><x-asterisk></x-asterisk> Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="select" {{ old('status') == null ? "selected" : "" }} disabled>Select which you are:</option>
                    <option value="student" {{ old('status') == 'student' ? "selected" : "" }}>Student</option>
                    <option value="faculty" {{ old('status') == 'faculty' ? "selected" : "" }}>Faculty</option>
                </select>
                @error('status')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </x-formrow>
            <x-formrow>
                <label for="name" class="form-label"><x-asterisk></x-asterisk> Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </x-formrow>
            <x-formrow>
                <label for="sid" class="form-label"><x-asterisk></x-asterisk> ID Number</label>
                <input type="text" name="sid" id="sid" class="form-control @error('sid') is-invalid @enderror" value="{{ old('sid') }}">
                @error('sid')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </x-formrow>
            <x-formrow>
                <label for="username" class="form-label"><x-asterisk></x-asterisk> Desired Username</label>
                <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}">
                @error('username')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </x-formrow>
            <x-formrow>
                <label for="email" class="form-label"><x-asterisk></x-asterisk> School Email</label>
                <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </x-formrow>
            <x-formrow>
                <label for="pemail" class="form-label">Personal Email</label>
                <input type="text" name="pemail" id="pemail" class="form-control @error('pemail') is-invalid @enderror" value="{{ old('pemail') }}">
                @error('pemail')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </x-formrow>
            <x-formrow>
                <label for="password" class="form-label"><x-asterisk></x-asterisk> Password</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}">
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </x-formrow>
            <x-formrow>
                <label for="cpassword" class="form-label"><x-asterisk></x-asterisk> Confirm Password</label>
                <input type="password" name="cpassword" id="cpassword" class="form-control @error('cpassword') is-invalid @enderror" value="{{ old('cpassword') }}">
                @error('cpassword')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </x-formrow>
            <x-formrow>
                <x-asterisk></x-asterisk>
                <input type="checkbox" name="terms" id="terms" {{ old('terms') != null ? 'checked' : '' }}>
                <label for="terms" class="form-label"> I have read and agree to the <a href="#">Terms & Conditions</a>.</label>
                @error('terms')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </x-formrow>
            <x-formrow>
                <x-asterisk></x-asterisk>
                <input type="checkbox" name="policy" id="policy" {{ old('policy') != null ? 'checked' : '' }}>
                <label for="policy" class="form-label"> I have read and agree to the <a href="#">Privacy Policy</a>.</label>
                @error('policy')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </x-formrow>
            
            <button type="submit" class="btn btn-success">Sign Up</button>
        </form>
    </div>
</x-template>