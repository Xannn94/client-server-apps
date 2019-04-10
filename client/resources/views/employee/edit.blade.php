@extends('layouts.app')

@php
    /** @var stdClass $employee /
    /** @var array $departmentsSelect */
    /** @var array $statuses */
@endphp

@section('content')
    <div class="jumbotron">
        <div class="row">
            <div class="col-10">
                <a href="{{ route('employees.index') }}" class="btn btn-outline-info">
                    <i class="fas fa-long-arrow-alt-left"></i>
                    Вернуться к списку
                </a>
            </div>
            <div class="col-2">
                <a href="{!! route('employees.show', $employee->id) !!}" class="btn btn-outline-primary">
                    <i class="fas fa-eye"></i>
                </a>
                <form action="{!! route('employees.destroy', $employee->id) !!}" method="POST" class="d-inline-block" accept-charset="UTF-8">
                    {!! csrf_field() !!}
                    <input name="_method" type="hidden" value="delete" />
                    <button type="submit" class="btn btn-outline-danger" title="Удалить">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </div>
        </div>
        <h1>
            Редактирование сотрудника
            <strong>{!! $employee->fio !!}</strong>
        </h1>
        <form action="{!! route('employees.update', $employee->id) !!}" method="POST">
            {!! csrf_field() !!}
            <input name="_method" type="hidden" value="put" />
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" placeholder="axiles94@gmail.com" value="{{ $employee->email }}">
            </div>
            <div class="form-group">
                <label for="fio">ФИО</label>
                <input type="text" name="fio" class="form-control" placeholder="Хан Александр Александрович" value="{{ $employee->fio }}">
            </div>
            <div class="form-group">
                <label for="phone">Телефон</label>
                <input type="number" name="phone" class="form-control" placeholder="0772186157" value="{{ $employee->phone }}">
            </div>
            <div class="form-group">
                <label for="address">Адрес</label>
                <input type="text" name="address" class="form-control" placeholder="ул. Советская 1" value="{{ $employee->address }}">
            </div>
            <div class="form-group">
                <label for="status">Статус</label>
                <select class="form-control" name="status">
                    @foreach($statuses as $key => $value)
                        <option value="{{ $key }}" @if($employee->status === $key) selected @endif>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Обновить</button>
        </form>
    </div>
@endsection