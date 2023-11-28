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

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!--[if lt IE 9]>
   <script src="assets/js/html5shiv.min.js"></script>
   <script src="assets/js/respond.min.js"></script>
  <![endif]-->


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

    <script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>


    @stack('graph')





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



    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>
