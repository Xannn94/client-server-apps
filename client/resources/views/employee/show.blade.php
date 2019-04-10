@extends('layouts.app')

@php
    /** @var stdClass $employee */
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
                <a href="{!! route('employees.edit', $employee->id) !!}" class="btn btn-outline-warning">
                    <i class="fas fa-edit"></i>
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

        <h1>{{ $employee->fio }}</h1>
        <hr class="my-4">
        <p><strong>Email: </strong> {{ $employee->email }}</p>
        <p><strong>Статус: </strong> {{ $statuses[$employee->status] }}</p>
        <p><strong>Пин: </strong> {{ $employee->pin }}</p>
        <p><strong>Телефон: </strong> {{ $employee->phone }}</p>
        <p><strong>Адрес: </strong> {{ $employee->address }}</p>
        <p><strong>Отдел: </strong> {{ $departmentTitle}}</p>
    </div>
@endsection