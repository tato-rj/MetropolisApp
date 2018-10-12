<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/primer.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        @include('components.navbar.layout')
        <main>
            @yield('content')
        </main>
    </div>

<script src="{{ asset('js/app.js') }}"></script>

<script type="text/javascript">
$('.toggle-finder').on('click', function() {
    let $this = $(this);
    let background = $this.attr('data-background');
    $('#lead').css('background-image', background);

    $this.addClass('btn-light').removeClass('btn-dark opacity-6').find('i').addClass('text-teal');
    $this.siblings().addClass('btn-dark opacity-6').removeClass('btn-light').find('i').removeClass('text-teal');
});
</script>
<script>
( function( factory ) {
    if ( typeof define === "function" && define.amd ) {

        // AMD. Register as an anonymous module.
        define( [ "../widgets/datepicker" ], factory );
    } else {

        // Browser globals
        factory( jQuery.datepicker );
    }
}( function( datepicker ) {

datepicker.regional[ "pt-BR" ] = {
    closeText: "Fechar",
    prevText: "&#x3C;Anterior",
    nextText: "Próximo&#x3E;",
    currentText: "Hoje",
    monthNames: [ "Janeiro","Fevereiro","Março","Abril","Maio","Junho",
    "Julho","Agosto","Setembro","Outubro","Novembro","Dezembro" ],
    monthNamesShort: [ "Jan","Fev","Mar","Abr","Mai","Jun",
    "Jul","Ago","Set","Out","Nov","Dez" ],
    dayNames: [
        "Domingo",
        "Segunda-feira",
        "Terça-feira",
        "Quarta-feira",
        "Quinta-feira",
        "Sexta-feira",
        "Sábado"
    ],
    dayNamesShort: [ "Dom","Seg","Ter","Qua","Qui","Sex","Sáb" ],
    dayNamesMin: [ "Dom","Seg","Ter","Qua","Qui","Sex","Sáb" ],
    weekHeader: "Sm",
    dateFormat: "DD, d 'de' MM 'de' yy",
    firstDay: 0,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: "",
    minDate: new Date(),
    sideBySide: true,
    icons: {
        up: "fa fa-chevron-circle-up",
        down: "fa fa-chevron-circle-down",
        next: 'fa fa-chevron-circle-right',
        previous: 'fa fa-chevron-circle-left'
    }
};
datepicker.setDefaults( datepicker.regional[ "pt-BR" ] );

return datepicker.regional[ "pt-BR" ];

} ) );

$( function() {
    today = moment().locale('pt').format("dddd, D [de] MMMM [de] YYYY");
    $( "#datepicker" ).val(today).datepicker();
} );
</script>
</body>
</html>
