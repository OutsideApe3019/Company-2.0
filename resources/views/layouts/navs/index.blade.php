@include('layouts.navs.navs.principal')

@can('panel.see')
    @include('layouts.navs.navs.panel')
@endcan