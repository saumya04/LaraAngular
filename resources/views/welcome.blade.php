<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel 5.3 with Angular 2.1</title>

        <!-- 1. Load libraries -->
        <!-- Polyfill(s) for older browsers -->
        <script src="{{ asset('core-js/client/shim.min.js') }}" ></script>
        <script src="{{ asset('zone.js/dist/zone.js') }}" ></script>
        <script src="{{ asset('reflect-metadata/Reflect.js') }}" ></script>
        <script src="{{ asset('systemjs/dist/system.src.js') }}" ></script>
        <script src="{{ asset('systemjs.config.js') }}" ></script>

        <script>
            System.import('app').catch(function(err){ console.error(err); });
        </script>

    </head>
    <body>
      Loading...
    </body>
</html>
