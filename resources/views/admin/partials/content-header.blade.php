<section class="content-header">

    <h1>{{ isset($title) ? $title :(isset($pluralTitle) ? $pluralTitle : '&nbsp;') }}
        @yield('addNewBtn')           
        
    </h1>

</section>