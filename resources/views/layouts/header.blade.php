<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, viewport-fit=cover">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')" />

    <meta property="og:title" content="@yield('title')" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="@yield('og_image')" />
    <meta property="og:description" content="@yield('description')">

    <link rel="icon" href="/img/logo.png">
{{--    <link rel="stylesheet" href="/libs/slick/slick.css">--}}
{{--    <link rel="stylesheet" href="/libs/slick/slick-theme.css">--}}
{{--    <link rel="stylesheet" href="/css/main.css">--}}
    <link rel="canonical" href="{{ url()->current() }}" />

    <link rel="alternate" hreflang="uk" href="{{ LaravelLocalization::getLocalizedURL('uk', null, [], true) }}"/>
    <link rel="alternate" hreflang="ru" href="{{ LaravelLocalization::getLocalizedURL('ru', null, [], true) }}"/>
    <link rel="alternate" hreflang="x-default" href="<?=str_replace(request()->root().'/uk', request()->root(), url()->current())?>"/>

    @yield('head')
</head>



<body>
    @yield('content')


    @include('layouts.footer')
