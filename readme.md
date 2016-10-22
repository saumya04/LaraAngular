# Laravel 5 integration with Angular 2

This repo helps you to get you up with Laravel 5.3 &amp; Angular 2 in minutes.

Larvel Version: **5.3.19**

Angular Version: **2.1.0**


## Installation Instructions

Steps for integration:

##### 1. Install Laravel to the specific directory (totally depends upon you)

```
composer create-project --prefer-dist laravel/laravel LaraAngular
```

##### 2. After installing Laravel give directories the specific persmissions in case of *Linux*

```
sudo chmod -R 777 storage/
sudo chmod -R 777 bootstrap/cache
```
Also generate project key using this command (if not generated)
```
php artisan key:generate
```

##### 3. Open up the ***package.json*** file in the root directory of your Laravel Project. Paste the below code into it.

```
{
  "private": true,
  "scripts": {
    "prod": "gulp --production",
    "dev": "gulp watch",
    "start": "tsc && concurrently \"npm run tsc:w\" \"npm run lite\" ",
    "lite": "lite-server",
    "postinstall": "typings install",
    "tsc": "tsc",
    "tsc:w": "tsc -w",
    "typings": "typings"
  },
  "dependencies": {
    "@angular/common": "~2.1.0",
    "@angular/compiler": "~2.1.0",
    "@angular/core": "~2.1.0",
    "@angular/forms": "~2.1.0",
    "@angular/http": "~2.1.0",
    "@angular/platform-browser": "~2.1.0",
    "@angular/platform-browser-dynamic": "~2.1.0",
    "@angular/router": "~3.1.0",
    "@angular/upgrade": "~2.1.0",
    "angular-in-memory-web-api": "~0.1.5",
    "bootstrap": "^3.3.7",
    "core-js": "^2.4.1",
    "elixir-typescript": "^2.0.0",
    "reflect-metadata": "^0.1.8",
    "rxjs": "5.0.0-beta.12",
    "systemjs": "0.19.39",
    "zone.js": "^0.6.25"
  },
  "devDependencies": {
    "bootstrap-sass": "^3.3.7",
    "gulp": "^3.9.1",
    "jquery": "^3.1.0",
    "laravel-elixir": "^6.0.0-9",
    "laravel-elixir-vue-2": "^0.2.0",
    "laravel-elixir-webpack-official": "^1.0.2",
    "lodash": "^4.16.2",
    "vue": "^2.0.1",
    "vue-resource": "^1.0.3",
    "concurrently": "^3.0.0",
    "lite-server": "^2.2.2",
    "typescript": "^2.0.3",
    "typings": "^1.4.0"
  }
}
```

##### 4. Create a new file named **tsconfig.json** in the root directory of your Laravel Project

```
{
  "compilerOptions": {
    "target": "es5",
    "module": "commonjs",
    "moduleResolution": "node",
    "sourceMap": true,
    "emitDecoratorMetadata": true,
    "experimentalDecorators": true,
    "removeComments": false,
    "noImplicitAny": false
  }
}
```

##### 5. Create a new file named ***typings.json*** in the root directory of your Laravel Project

```
{
  "globalDependencies": {
    "core-js": "registry:dt/core-js#0.0.0+20160725163759",
    "jasmine": "registry:dt/jasmine#2.2.0+20160621224255",
    "node": "registry:dt/node#6.0.0+20160909174046"
  }
}
```

##### 6. Now run the below mentioned command in your terminal *(before running this command you should have installed npm globally on your OS)*

```
npm install
```
> This will install all the necessary packages from ***Node Package Modules*** Server

##### 7. After finishing up the packages installation go to - `node_modules > elixir-typescript > index.js` file and comment out this line as shown in code

```
// .pipe($.concat(paths.output.name))
```
> We've done this to **avoid the concatenation of js/ts files**

##### 8. Now we're done with our initial required setup. After completing all the above steps create a new directory (named **typescript**) at `resources > assets > typescript`

##### 9. Now we're starting with creating our angular files. We need to create 3 files required for angular to start with.
- *app.component.ts*
- *app.module.ts*
- *main.ts*

> These file will be created in the directory `resources/assets/typescript`

##### 10. The code for all the 3 files is given below

File: `app.component.ts`
```
import { Component } from "@angular/core";

@Component({
  selector: 'body',
  template: '<h1>Hello Laravel 5.3 and Angular 2.1</h1>'
})

export class AppComponent { }
```

File: `app.module.ts`
```
///<reference path="../../../typings/index.d.ts"/>
import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { AppComponent }   from './app.component';

@NgModule({
  imports:      [ BrowserModule ],
  declarations: [ AppComponent ],
  bootstrap:    [ AppComponent ]
})

export class AppModule { }
```
> Remember to include `///<reference path="../../../typings/index.d.ts"/>` at the top of the file to avoid errors while compilation

File: `main.ts`
```
import { platformBrowserDynamic } from '@angular/platform-browser-dynamic';
import { AppModule } from './app.module';
const platform = platformBrowserDynamic();
platform.bootstrapModule(AppModule);
```

##### 11. Open up `gulpfile.js` from the root directory of your Laravel Project and paste the below code into it.

```
const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');
require('elixir-typescript');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix
    .sass('*.scss')
    .webpack('app.js')
    .copy('node_modules/@angular', 'public/@angular')
    .copy('node_modules/anular2-in-memory-web-api', 'public/anular2-in-memory-web-api')
    .copy('node_modules/core-js', 'public/core-js')
    .copy('node_modules/reflect-metadata', 'public/reflect-metadata')
    .copy('node_modules/systemjs', 'public/systemjs')
    .copy('node_modules/rxjs', 'public/rxjs')
    .copy('node_modules/zone.js', 'public/zone.js')

    .typescript(
        [
            'app.component.ts',
            'app.module.ts',
            'main.ts'
        ],
        'public/app',
        {
            "target": "es5",
            "module": "system",
            "moduleResolution": "node",
            "sourceMap": true,
            "emitDecoratorMetadata": true,
            "experimentalDecorators": true,
            "removeComments": false,
            "noImplicitAny": false
        }
    );
});
```

##### 12. Create a directory named (**app**) in the public directory of your Laravel Project - `public/app` 

##### 13. Then run the below command in your terminal

```
gulp
```
> After executing the above command, all the **SASS/SCSS, TS** files will be compiled and moved to the `public` directory > of your Laravel Project

##### 14. Create a file `systemjs.config.js` in your public directory.

```
/**
 * System configuration for Angular samples
 * Adjust as necessary for your application needs.
 */
(function (global) {
  System.config({
    paths: {
      // paths serve as alias
      'npm:': './'
    },
    // map tells the System loader where to look for things
    map: {
      // our app is within the app folder
      app: 'app',
      // angular bundles
      '@angular/core': 'npm:@angular/core/bundles/core.umd.js',
      '@angular/common': 'npm:@angular/common/bundles/common.umd.js',
      '@angular/compiler': 'npm:@angular/compiler/bundles/compiler.umd.js',
      '@angular/platform-browser': 'npm:@angular/platform-browser/bundles/platform-browser.umd.js',
      '@angular/platform-browser-dynamic': 'npm:@angular/platform-browser-dynamic/bundles/platform-browser-dynamic.umd.js',
      '@angular/http': 'npm:@angular/http/bundles/http.umd.js',
      '@angular/router': 'npm:@angular/router/bundles/router.umd.js',
      '@angular/forms': 'npm:@angular/forms/bundles/forms.umd.js',
      // other libraries
      'rxjs':                      'npm:rxjs',
      'angular-in-memory-web-api': 'npm:angular-in-memory-web-api',
    },
    // packages tells the System loader how to load when no filename and/or no extension
    packages: {
      app: {
        main: './main.js',
        defaultExtension: 'js'
      },
      rxjs: {
        defaultExtension: 'js'
      },
      'angular-in-memory-web-api': {
        main: './index.js',
        defaultExtension: 'js'
      }
    }
  });
})(this);
```

##### 15. Now we're done with our integration. We now have to just show up our first output from Angular onto our screen. Goto `resources/views/welcome.blade.php` and write the following lines inside it.

```
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
```

> Run the project by simply executing the command in your terminal `php artisan serve` and just open up the link in your favourite browser `http://localhost:8000/`. Tada it should seems to be working now! :D

Credits &amp; References
=============

- [Laravel Documentation](https://laravel.com/docs/5.3)
- [Angular Documentation](https://angular.io/docs/ts/latest/quickstart.html)
