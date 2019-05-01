@extends('layouts.app')

@section('content')
    <div class="uk-container">
        <h1>Сохрани кусок текста (с заголовком)</h1>
        <form class="uk-form-horizontal uk-margin-large" method="post" action="">
            <div class="uk-margin">
                <label class="uk-form-label" for="inputHeader">Заголовок</label>
                <div class="uk-form-controls">
                    <input class="uk-input" id="inputHeader" type="text" name="header">
                </div>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="selectTime">Время жизни</label>
                <div class="uk-form-controls">
                    <select class="uk-select" id="selectTime" name="time">
                        <option value="10min">10мин</option>
                        <option value="hour">1час</option>
                        <option value="3hours">3часа</option>
                        <option value="day">1день</option>
                        <option value="month">1месяц</option>
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
                <div class="uk-form-label">Паста</div>
                <div class="uk-form-controls uk-form-controls-text">
                    <textarea class="uk-textarea" rows="5"></textarea>
                </div>
            </div>
            <div class="uk-margin">
                <button class="uk-button uk-button-default">Button</button>
            </div>
        </form>
    </div>
@endsection
