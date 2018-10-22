( 
    function( factory ) {
        if ( typeof define === "function" && define.amd ) {

            // AMD. Register as an anonymous module.
            define( [ "../widgets/datepicker" ], factory );
        } else {

            // Browser globals
            factory( jQuery.datepicker );
        }
    }

    ( 
        function( datepicker ) {
            datepicker.regional[ "pt-BR" ] = {
                closeText: "Fechar",
                prevText: "&#x3C;Anterior",
                nextText: "Próximo&#x3E;",
                currentText: "Hoje",
                monthNames: [ "janeiro","fevereiro","março","abril","maio","junho",
                "julho","agosto","setembro","outubro","novembro","dezembro" ],
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
                dateFormat: "d 'de' MM 'de' yy",
                firstDay: 0,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: "",
                minDate: new Date(),
                sideBySide: true,
            };

            datepicker.setDefaults( datepicker.regional[ "pt-BR" ] );

            return datepicker.regional[ "pt-BR" ];
        }
    )
);