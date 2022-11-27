<?php
/**
 * @var array $lessons
 */

use App\Models\Employee;

?>
@extends('layouts.main')
@section('styles')
    <link href="{{ asset('css/main/style.css') }}" rel="stylesheet">
    <link type="Image/x-icon" href="{{asset('/asset/main/Book_logo_project.ico')}}" rel="icon">
@endsection
@section('scripts')
    <script src="{{asset('js/main/app.js')}}"></script>
@endsection
@section('title', 'Liber')
@section('content')
    <div class="hidden-menu">
        <nav>
            <ul class="hidden-menu-ul">
                <li><a href="" class="menu_item_5">Личный кабинет</a></li>
                <li><a href="" class="menu_item_4">Уведомления</a></li>
                <li><a href="{{route('logout')}}"
                       class="menu_item_4">Выйти({{\Illuminate\Support\Facades\Auth::user()->name}}</a></li>
            </ul>
        </nav>
    </div>
    <header class="header">
        <div class="header_logo">
            <a href="{{route('welcome')}}">Liber_</a>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <div class="header_menu menu">
                <nav class="menu_list">
                    <ul class="menu_items">
                        <li><a href="" class="menu_item">Личный кабинет</a></li>
                        <li><a href="" class="menu_item_1">Уведомления</a></li>
                        <li><input type="submit" class="menu_item_1"
                                   value="Выйти({{\Illuminate\Support\Facades\Auth::user()->name}})"></li>
                    </ul>
                </nav>
            </div>
        </form>
        <div class="burger">
            <div class="burger_line one"></div>
            <div class="burger_line two"></div>
            <div class="burger_line three"></div>
        </div>
    </header>
    <!--   MAIN  -->
    <main class="main">
        <div class="container">
            <div class="col_1"></div>
            <div class="col_2">
                <div class="less_time">Расписание на {{date('d.m.Y')}}</div>
                <div class="col_in">
                    @foreach($lessons as $lesson)
                        <?php
                        $oldTime = strtotime($lesson->startLesson->time);
                        $active = strtotime(date('H:i')) < $oldTime;
                        $newTime = date("H:i", strtotime('+90 minutes', $oldTime));
                        $profile = Employee::query()->where('s_user', '=', $lesson->userCreator->id)->first();
                        ?>
                        <div class="<?=$active ? 'col_lesson_active' : 'col_lesson'?>">
                            <div class="les_time">
                                <p>{{date('H:i', $oldTime)}} - {{$newTime}}</p>
                                @if($active)
                                    <a class="btn_1" href="{{$isEmployee? route('questions', ['id' => $lesson->id]): route('lesson', ['id' => $lesson->id])}}">Перейти</a>
                                @endif
                            </div>
                            <div class="less_inner">Дисциплина - {{$lesson->subject->name}}
                                <div class="teacher">Преподаватель
                                    - {{$profile->surname}} {{mb_substr($profile->first_name,0,1)}}
                                    . {{mb_substr($profile->patronymic,0,1)}}.
                                </div>
                                <div class="audience">Аудитория - {{$lesson->room}}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <p> - </p>
            </div>
            <h1></h1></div>


        </div>
    </main>
    <!--    FOOTER -->
    <footer class="footer" style="background-color: rgba(128, 128, 128, 0.416);">
        <div class="footer_in">
            <div class="footer_col">

                <div class="footer_link">
                    <a class="links" href="https://sfedu.ru/www/stat_pages22.show?p=ABT/N8202">Правила приёма</a>
                    <a class="links" href="https://sfedu.ru/www/stat_pages22.show?p=ABT/olymps/P">Олимпиады</a>

                    <a class="links" href="https://sfedu.ru/www/stat_pages22.show?p=ABT/N8220">Статистика</a>
                </div>

                <div class="footer_faq">
                    <a class="faq" href="https://sfedu.ru/www/stat_pages22.show?p=STD/rasp/D">Расписание</a>
                    <a class="faq" href="https://sfedu.ru/www/stat_pages22.show?p=EDU/N10055/D">Образование</a>
                    <a class="faq" href="https://sfedu.ru/dpo">Доп образование</a>
                </div>
                <div class="footer_blog">
                    <a class="blogs" href="https://sfedu.ru/www/stat_pages22.show?p=EDU/N10055/D">Уникальная научная
                        установка</a>
                    <a class="blogs" href="https://sfedu.ru/www/stat_pages22.show?p=PNO/main/M">Научное оборудование</a>
                </div>
                <div class="place">
                    <div class="placment">(+7 863) 218-40-00</div>
                    <a class="placeses" href="https://www.google.com/maps/@47.202136,38.9330083,17z?hl=ru">г.Тагарог,
                        Некрасовский переулок 44</a>

                </div>
            </div>
        </div>
    </footer>
@endsection
