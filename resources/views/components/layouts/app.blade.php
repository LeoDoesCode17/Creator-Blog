<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>

        @livewireStyles
        @vite(['resources/js/app.js', 'resources/css/app.css'])

    </head>
    <body>
        <div class="min-h-full">
            
            <livewire:nav-bar />
            <livewire:header :title="$title ?? 'Page Title'"/>
            <main>
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div> 
        @livewireScriptConfig
    </body>
</html>
