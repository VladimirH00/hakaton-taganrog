<?php
?>

<?php
/**
 * @var array $lessons
 */

use App\Models\Employee;use App\Models\Question;use App\Models\Student;use Illuminate\Support\Facades\Auth;

$i = 1;
$j = 0;
$user = Auth::user();
$student = Student::query()->where('s_user', '=', $user->id)->first();
?>
@extends('layouts.main')
@section('styles')
    <link href="{{ asset('css/main/style.css') }}" rel="stylesheet">
    {{--    <link href="{{ asset('css/lesson/style.css') }}" rel="stylesheet">--}}
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
                <li><a href="#" class="menu_item_4">Уведомления</a></li>
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
        @if($questions->count()==0)
            <div class="text-container" style="text-align: center; margin-top: 100px; font-size: 20pt">
                <p>Вы подключились к лекции</p>
                <p>Ожидайте вопросов от преподователя</p>
            </div>
        @else
            <div style="text-align: center;
             margin-top: 50pt; display: flex;
              flex-direction: column; justify-content: center;align-items: center">
                @foreach($questions as $question)
                    <?php
                    $questionsVariable = Question::query()->where('s_question_group', '=', $question->id)->get();
                    ?>
                    <div class="test"
                         style="color:white;font-size:18pt;background-color: rgba(128, 128, 128, 0.416); min-width: 60%; border-radius: 15pt; margin-bottom: 25pt;">
                        <div style="margin-bottom: 20pt;">Вопрос № {{$i++}}</div>
                        <div class="gues" style="margin-bottom: 20pt;">
                            <div>{{$question->name}}</div>
                        </div>
                        <form method="post" action="{{route('questions.select', ['id' => $lesson->id])}}">
                            @csrf
                            <div>

                                @foreach($questionsVariable as $variable)
                                    <div style="margin-bottom: 5pt; display: flex; justify-content: center">

                                        <input type="radio" id="contactChoice{{$j}}"
                                               name="question-value-true" value="{{$variable->id}}">
                                        <label for="contactChoice{{$j++}}">
                                            <div>{{$variable->name}}</div>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @if(\App\Models\QuestionChoose::query()->where('s_student', '=', $student->id)
                                    ->where('s_question_group', '=', $question->id)->get()->count() ==0)
                                <input class="menu_item_1" style="margin-top: 15pt; " type="submit"
                                       value="Отправить">
                            @endif
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
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
