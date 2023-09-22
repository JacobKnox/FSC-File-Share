<x-template pageName="Files">
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 justify-content-center">
            @foreach($files as $file)
                <div class="col text-center">
                    <a href="/files/{{$file->id}}" class="link-dark">
                        <p class="h2">{{ $file->title }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-template>