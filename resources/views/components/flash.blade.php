@if ( session('success') )        
    @component( 'components.toast' )
        @slot( 'class', 'success' )
        @slot( 'name', 'Éxito' )
        @slot( 'message', session('success') )
    @endcomponent
@endif

@if (session('info'))
    @component( 'components.toast' )
        @slot( 'class', 'info' )
        @slot( 'name', 'Información' )
        @slot( 'message', session('info') )
    @endcomponent
@endif

@if (session('warning'))
    @component( 'components.toast' )
        @slot( 'class', 'warning' )
        @slot( 'name', 'Advertencia' )
        @slot( 'message', session('warning') )
    @endcomponent
@endif

@if (session('danger'))
    @component( 'components.toast' )
        @slot( 'class', 'danger' )
        @slot( 'name', 'Advertencia' )
        @slot( 'message', session('danger') )
    @endcomponent
@endif

@if ( $errors->any() )
    @foreach ( $errors->all() as $error )
        @component( 'components.toast' )
            @slot( 'class', 'danger' )
            @slot( 'name', 'Error' )
            @slot( 'message', $error )
        @endcomponent
    @endforeach
@endif