<html ng-app="planner">
<head>
    <title>MeetUp Planner</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/master.css" type="text/css">
</head>
<body ng-controller="MainController" ng-cloak>
    <div class="container">
        <div class="row row-centered planner-block">
            <div class="col-md-12">
                <div class="col-md-5 col-centered form-area">
                    <div class="row row-centered">
                        @yield('signup')
                        @yield('event')
                        @yield('displayEvents')
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="js/master.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDDRiA4O1OZ6TeevNNNQUOOCW5uxTZNb-s&libraries=places&callback=initAutocomplete" async defer></script>
</body>
</html>