<x-template pageName="Admin Dashboard">
    <p class="h5 text-center">Bug Reports</p>
    <div class="container">
        <div class="row row-cols-3">
            @each('components.cards.bug', $bugs, 'bug', 'components.empties.bug')
        </div>
    </div>
    <p class="h5 text-center">Auto Mod Alerts</p>
    <div class="container">
        <div class="row row-cols-3">
            @each('components.cards.automod', $automod, 'report', 'components.empties.automod')
        </div>
    </div>
    <p class="h5 text-center">User Reports</p>
    <div class="container">
        <div class="row row-cols-3">
            @each('components.cards.report', $reports, 'report', 'components.empties.report')
        </div>
    </div>
</x-template>