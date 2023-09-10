<x-template>
    <x-slot:pageName>
        Home
    </x-slot>
    <div class="container-fluid">
        <div class="row mx-2 px-2">
            <div class="col-12 col-md-6">
                <p class="fs-2 fw-semibold">Mission</p>
                <p>FSC File Share is a file sharing website that is meant to act as a public repository for works produced by students of Florida Southern College. These works can include, but not be limited to, essays, research papers, and presentations.</p>
            </div>
            <div class="col-12 col-md-6">
                <p class="fs-2 fw-semibold">About</p>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">History</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Development</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Developer</button>
                    </li>
                </ul>
                <div class="tab-content mt-2" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        FSC File Share came to me one day as I was brainstorming ideas for my Honors senior project. I wanted something that would both apply the skills I already learned and challenge me to learn more. Then I thought about how I often like to share papers and projects I've done for my courses that I was proud of, which led me to the idea of building a website for that specific purpose.
                    </div>
                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        <p class="h5">Pre-Alpha (September 4th, 2023 - Ongoing)</p>
                        <p>Currently building the skeleton of the website. Will update as development progresses.</p>
                    </div>
                    <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                        Hello, my name is Jacob Knox. I am expecting my Bachelor's of Science in Computer Science (AI and Web concentrations) and Applied Mathematics (STEM concentration) from Florida Southern College in May 2024. I have a data analtyics minor, and I am a part of the Honors program. Once I graduate, I am aiming to be a software engineer/developer.
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-template>