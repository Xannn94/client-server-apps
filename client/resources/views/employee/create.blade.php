@extends('layouts.app')

@php
    /** @var stdClass $employee /
    /** @var array $departmentsSelect */
    /** @var array $statuses */
@endphp

@section('content')
    <div class="jumbotron">
        <h1 class="display-4">
            Добавление нового сотрудника
        </h1>
        <form action="{!! route('employees.store') !!}" method="POST">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" placeholder="axiles94@gmail.com" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('email') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="fio">ФИО</label>
                <input type="text" name="fio" class="form-control" placeholder="Хан Александр Александрович" value="{{ old('fio') }}">
                @if($errors->has('fio'))
                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('fio') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="fio">Пин</label>
                <input type="text" name="pin" class="form-control" placeholder="123456789" value="{{ old('pin') }}">
                @if($errors->has('pin'))
                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('pin') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="phone">Телефон</label>
                <input type="number" name="phone" class="form-control" placeholder="996772186157" value="{{ old('phone') }}">
                @if($errors->has('phone'))
                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('phone') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="address">Адрес</label>
                <input type="text" name="address" class="form-control" placeholder="ул. Советская 1" value="{{ old('address') }}">
                @if($errors->has('address'))
                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('address') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="status">Статус</label>
                <select class="form-control" name="status">
                    @foreach($statuses as $key => $value)
                        <option value="{{ $key }}" @if(old('status') == $key) selected @endif>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="status">Отдел</label>
                <select class="form-control" name="department_id">
                    @foreach($departmentsSelect as $key => $value)
                        <option value="{{ $key }}" @if(old('department_id') == $key) selected @endif>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection