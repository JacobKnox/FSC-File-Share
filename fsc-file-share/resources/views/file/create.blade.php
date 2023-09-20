<x-template pageName="File Upload">
    <form action="POST" action='/files/create'>
        @csrf
        <div class="{{ config('styles.formRow') }}">
            <div class="col-8">
                <label for="title" class="form-label"><x-asterisk></x-asterisk> Title</label>
            </div>
        </div>
    </form>
</x-template>