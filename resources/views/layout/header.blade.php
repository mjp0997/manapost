<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">

   <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>ManaPost</title>

   <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
   <header class="Header">
      <button class="Header__Button"><span class="icon-menu"></span></button>
      <img class="Header__Logo" src="{{ asset('media/Logo ManaPost 2.png') }}">
      <form action="{{ url('/logout') }}" method="POST">
         @csrf
         
         <button type="submit" class="logout">Cerrar sesión</button>
      </form>
   </header>