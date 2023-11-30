<x-template pageName="Admin Dashboard">
    <p class="h5 mb-3 text-center">Bug Reports</p>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
            @each('components.cards.bug', $bugs, 'bug', 'components.empties.bug')
        </div>
    </div>
    <p class="h5 mb-3 text-center">Auto Mod Alerts</p>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
            @each('components.cards.report', $automod, 'report', 'components.empties.automod')
        </div>
    </div>
    <p class="h5 mb-3 text-center">User Reports</p>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
            @each('components.cards.report', $reports, 'report', 'components.empties.report')
        </div>
    </div>
</x-template>