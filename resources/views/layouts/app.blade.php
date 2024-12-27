<!doctype html>
<html>

<head>
    @stack('title')
    @include('includes.meta')
    @stack('before-styles')
    @include('includes.style')
    @stack('after-styles')
</head>

<body>
    <main
        class="bg-[#FAFAFA] max-w-[640px] mx-auto min-h-screen relative flex flex-col has-[#CTA-nav]:pb-[120px] has-[#Bottom-nav]:pb-[120px]">
        @yield('content')
        @hasSection('disable-navigation')
            {{-- Navigation is disabled for this page --}}
        @else
            @include('components.navigation')
        @endif

        @stack('before-script')
        @include('includes.script')
        @stack('after-script')
    </main>
</body>

</html>
