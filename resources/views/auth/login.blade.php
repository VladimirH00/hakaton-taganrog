<?php

?>

@extends('layouts.main')
@section('styles')
    <link href="{{ asset('css/reg/log.css') }}" rel="stylesheet">
@endsection
@section('scripts')
    <script src="{{asset('js/reg/reg.js')}}"></script>
@endsection
@section('title', 'Авторизация')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="logo">
        <p class="reg">Регистрация</p>
    </div>
    <div class="image">
        <img src="{{asset('assets/reg/reg.svg')}}" alt="">
    </div>
    <div class="container">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <label for="emailReg"><p>E-mail</p></label>
            <input type="text" placeholder="E-mail" name="emailReg" value="{{old('emailReg')?old('emailReg') : ''}}">

            <label for="bookReg"><p>Номер зачётной книжки</p></label>
            <input type="text" placeholder="Номер зачётной книжки" name="bookReg" value="{{old('bookReg')?old('bookReg') : ''}}">

            <label for="passwordReg"><p>Пароль</p></label>
            <input type="password" placeholder="Пароль" name="passwordReg">

            <label for="passwordReg_confirmation"><p>Повторите пароль</p></label>
            <input type="password" placeholder="Повторите пароль" name="passwordReg_confirmation" >
            <button type="submit" class="registerbtn">Регистрация</button>
        </form>
        <div class="signin">
            <p>Уже есть аккаунт? <a href="#" class="signBtn">Войдите</a>.</p>
        </div>
    </div>
    <div class="wrapper">
        <div class="logo">
            <p class="reg">Вход</p>
        </div>
        <div class="image">
            <img src="{{asset('assets/reg/login.svg')}}" alt="">
        </div>
        <div class="container">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <label for="email"><p>E-mail</p></label>
                <input type="text" placeholder="E-mail" name="email" value="{{old('email')?old('email') : ''}}">

                <label for="book"><p>Номер зачётной книжки</p></label>
                <input type="text" placeholder="Номер зачётной книжки" name="book" value="{{old('book')?old('book') : ''}}">

                <label for="password"><p>Пароль</p></label>
                <input type="password" placeholder="Пароль" name="password" >
                <div class="signin"></div>
                <button type="submit" class="registerbtn">Вход</button>
            </form>
            <p class="regbtn">Нет аккаунта? <a href="#" class="regBtn">Зарегистрируйтесь</a>.</p>
        </div>
    </div>
@endsection
