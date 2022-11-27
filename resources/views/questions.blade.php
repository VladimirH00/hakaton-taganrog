<?php
/**
 * @var array $lesson
 */

use App\Models\Employee;use App\Models\StudentQuestions;
$i = 1;
?>
@extends('layouts.main')
@section('styles')
    <link href="{{ asset('css/main/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/questions/style.css') }}" rel="stylesheet">
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
                <li><a href="{{route('personal')}}" class="menu_item_5">Личный кабинет</a></li>
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
                        <li><a href="{{route('personal')}}" class="menu_item">Личный кабинет</a></li>
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
        <div style="background-color: rgba(128, 128, 128, 0.416); padding: 20px; border-radius: 15pt">
            <form method="post" action="{{route('questions.store', ['id' => $lesson->id])}}">
                @csrf
                <div style="margin-bottom: 10pt; display: flex; justify-content: center;">
                    <label class="form-container-label-header" for="question">Вопрос: </label>
                    <textarea type="text" name="question"></textarea>
                </div>
                <div>
                    <div style="margin-bottom: 5pt; display: flex; justify-content: space-between">
                        <label for="contactChoice1">Ответ 1: </label>
                        <input type="radio" id="contactChoice1"
                               name="question-value-true" value="one">
                        <input type="text" name="one" id="">
                    </div>
                    <div style="margin-bottom: 5pt; display: flex; justify-content: space-between">
                        <label for="contactChoice2">Ответ 2: </label>
                        <input type="radio" id="contactChoice2"
                               name="question-value-true" value="two">
                        <input type="text" name="two" id="">
                    </div>

                    <div style="margin-bottom: 5pt; display: flex; justify-content: space-between">
                        <label for="contactChoice3">Ответ 3: </label>
                        <input type="radio" id="contactChoice3"
                               name="question-value-true" value="three">
                        <input type="text" name="three" id="">
                    </div>

                    <div style="margin-bottom: 5pt; display: flex; justify-content: space-between">
                        <label for="contactChoice4">Ответ 4: </label>
                        <input type="radio" id="contactChoice4"
                               name="question-value-true" value="three">
                        <input type="text" name="four" id="">
                    </div>
                </div>
                <input class="menu_item_1" style="margin-top: 15pt; float: right" type="submit" value="Добавить">
            </form>
        </div>
        @if(!$questions->count())
            <h3>Вопросы отсутствуют</h3>
        @endif
        @foreach($questions as $question)
            <?php
            $published = StudentQuestions::query()->where('s_question_group', '=', $question->id)->exists()
            ?>
            <div class="test">
                <p>Вопрос № {{$i++}}</p>
                <div class="gues">
                    <p>{{$question->name}}</p>
                </div>
                @if(!$published)
                    <div class="btnGues"
                         onclick="window.location = '{{route('question.post', ['id'=>$question->id])}}';">Отправить
                    </div>
                @endif
            </div>
        @endforeach
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
