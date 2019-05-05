@extends('layouts.app')

@section('content')
    <div class="uk-container">
        <h1>Сохрани кусок текста (с заголовком)</h1>
        @if ($errors->any())
            <div class="uk-margin uk-alert-warning" uk-alert>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="uk-form-horizontal uk-margin-large" method="post" action="/createPasta">
            @csrf
            <div class="uk-margin">
                <label class="uk-form-label" for="inputTitle">Заголовок</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="inputTitle" type="text" name="title">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="selectTime">Время жизни</label>
                <div class="uk-form-controls">
                    <select class="uk-select" id="selectTime" name="time">
                        <option value="10min">10мин</option>
                        <option value="1hour">1час</option>
                        <option value="3hour">3часа</option>
                        <option value="1day">1день</option>
                        <option value="1month">1месяц</option>
                        <option value="nolimit">без ограничения</option>
                    </select>
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="selectAccess">Доступ</label>
                <div class="uk-form-controls">
                    <select class="uk-select" id="selectAccess" name="access">
                        <option value="public">Доступный всем</option>
                        <option value="unlisted">Только по ссылке</option>
                        <option value="private">Только автору</option>
                    </select>
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="textareaText">Паста</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <textarea class="uk-textarea" id="textareaText" rows="5" name="text"></textarea>
                </div>
            </div>
            <div class="uk-margin">
                <button class="uk-button uk-button-default">Button</button>
            </div>
        </form>
    </div>
@endsection
