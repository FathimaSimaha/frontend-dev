<!-- meta tags and other links -->
<x-head />

<body>
    <!-- side bar -->
    <x-sidebar.side-bar />

    <main class="dashboard-main">

        <!-- navbar -->
        <x-navigationbar.navbar />


        {{-- content --}}
        {{ $slot }}

        <!-- footer -->
        <x-footer />

    </main>

    {{-- script --}}
    <x-script :pageScripts="$pageScripts ?? []" />


</body>
