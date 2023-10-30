<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Courtage - Application de gestion des courtiers">
    <meta name="keywords" content="Projects">
    <meta name="author" content="Fl4ir">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="robots" content="noindex, nofollow">
    <title>Courtage - Application pour les courtiers</title>

    <link rel="shortcut icon" type="image/x-icon" href="2.png">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/material.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/line-awesome.min.css') }}">

    {{-- <link rel="stylesheet" href="assets/plugins/morris/morris.css"> --}}

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.5/css/buttons.dataTables.min.css"> --}}

    {{-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/print-js/dist/print.min.js"></script> --}}

    <!--[if lt IE 9]>
   <script src="assets/js/html5shiv.min.js"></script>
   <script src="assets/js/respond.min.js"></script>
  <![endif]-->

    {{-- <style type="text/css">
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }

        #container {
            height: 400px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
    </style> --}}

</head>

<body>
    <div id="app">
        <router-view></router-view>
    </div>


    {{-- <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>

    {{-- <script src="assets/plugins/morris/morris.min.js"></script> --}}
    <script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    {{-- <script src="assets/js/chart.js"></script> --}}

    {{-- <script src="assets/plugins/apexcharts/apexcharts.min.js"></script> --}}

    {{-- <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script> --}}

    @stack('graph')

    {{-- <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.html5.min.js"></script> --}}


    <!-- Datatable-->
    {{-- <script>
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
            $('#exemple').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
            $('#exemple1').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
            $('#exemple2').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
            $('#exemple3').DataTable({
                scrollX: true
            });
            $('#exemple4').DataTable({
                scrollX: true
            });
        });
    </script> --}}

    <!-- Hide and show-->
    <script>
        $(document).ready(function() {
            $(".ajout").click(function() {
                $(".form1").show();
                $(".form2").show();
                $(".ajout").hide();
                $(".adresse").hide();
            });
            $(".form2").click(function() {
                $(".form1").hide();
                $(".form2").hide();
                $(".ajout").show();
                $(".adresse").show();
            });
            $(".ajouter").click(function() {
                $(".form3").show();
                $(".form4").show();
                $(".ajouter").hide();
                $(".profession").hide();
            });
            $(".form4").click(function() {
                $(".form3").hide();
                $(".form4").hide();
                $(".ajouter").show();
                $(".profession").show();
            });
            $(".ajoutzone").click(function() {
                $(".form5").show();
                $(".form6").show();
                $(".ajoutzone").hide();
                $(".zone").hide();
            });
        });
    </script>

    <!-- Sidebar-->
    <script>
        $(document).ready(function() {
            var urlcourant = document.location.href
            urlcourant = urlcourant.replace(/\/$/, "")

            var queurl = urlcourant.substring(urlcourant.lastIndexOf("/") + 1)

            // Module

            if (queurl == 'synthese') {
                queurl = 'modulestat'
            }

            if (queurl == 'productions') {
                queurl = 'modulestat'
            }

            if (queurl == 'sinis') {
                queurl = 'modulestat'
            }

            if (queurl == 'tbdepense') {
                queurl = 'modulestat'
            }

            if (queurl == 'tbrh') {
                queurl = 'modulestat'
            }

            // Courtage (Contrat)

            if (queurl == 'uploads') {
                queurl = 'modulecourtage'
            } else if (queurl == 'createcontrat') {
                queurl = 'modulecourtage'
            } else if (queurl.includes("addavenant")) {
                queurl = 'modulecourtage'
            } else if (queurl.includes("viewfacture")) {
                queurl = 'modulecourtage'
            }else if (queurl.includes("modifcontrat")) {
                queurl = 'modulecourtage'
            }


            if (queurl == 'apporteur') {
                queurl = 'modulecourtage'
            } else if (queurl.includes("modifapporteur")) {
                queurl = 'modulecourtage'
            }


            if (queurl == 'contrat') {
                queurl = 'modulecourtage'
            }
            if (queurl == 'sinistre') {
                queurl = 'modulecourtage'
            } else if (queurl == 'creersinistre') {
                queurl = 'modulecourtage'
            } else if (queurl.includes("addreglement")) {
                queurl = 'modulecourtage'
            } else if (queurl.includes("sinistre")) {
                queurl = 'modulecourtage'
            }

            if (queurl == 'relance') {
                queurl = 'modulecourtage'
            } else if (queurl == 'createrelance') {
                queurl = 'modulecourtage'
            }

            if (queurl == 'compagnie') {
                queurl = 'modulecourtage'
            } else if (queurl == 'createcompagnie') {
                queurl = 'modulecourtage'
            } else if (queurl.includes("modifcompagnie")) {
                queurl = 'modulecourtage'
            } else if (queurl.includes("addauto")) {
                queurl = 'modulecourtage'
            }
            if (queurl == 'branche') {
                queurl = 'modulecourtage'
            } else if (queurl == 'createbranche') {
                queurl = 'modulecourtage'
            }
            if (queurl == 'prospect') {
                queurl = 'modulecourtage'
            } else if (queurl == 'createprospect') {
                queurl = 'modulecourtage'
            }
            if (queurl == 'client') {
                queurl = 'modulecourtage'
            }

            if (queurl == 'tbrh') {
                queurl = 'modulestat'
            }

            if (queurl == 'users') {
                queurl = 'modulerh'
            }

            $("a.menu").removeClass("active")

            $("#" + queurl).addClass("active")

        })
    </script>

    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>
