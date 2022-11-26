<?php

?>

@component('layouts.head')
    @yield('title')
    @yield('styles')
@endcomponent
<body>
    @yield('content')
    @yield('footer', View::make('layouts.footer'))
    @yield('scripts')
</body>
