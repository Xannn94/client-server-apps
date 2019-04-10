@extends('layouts.app')

@php
    /** @var array $departmentsSelect */
    /** @var int|null $departmentId */
    /** @var array $employees */
    /** @var array $links */
@endphp

@section('content')
    <form action="{{ route('employees.index') }}" method="GET">
        <div class="row">
            <div class="col-12">
                <label for="exampleFormControlSelect1">Выберите отдел</label>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <select class="form-control" name="department_id">
                        @foreach($departmentsSelect as $key => $value)
                            <option value="{{ $key }}" @if($departmentId == $key) selected @endif>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-2 align-self-center">
                <div class="form-group">
                    <input type="submit" class="btn btn-primary">
                </div>
            </div>
            <div class="col-6 text-right">
                <a href="{!! route('employees.create') !!}" class="btn btn-success">
                    Добавить сотрудника
                </a>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-12">
            <table class="table table-hover table-dark">
                <thead>
                <tr>
                    <th scope="col">ФИО</th>
                    <th scope="col">Отдел</th>
                    <th scope="col" class="text-right">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>{{ $employee->fio }}</td>
                        <td>{{ $departmentsSelect[$employee->department_id]}}</td>
                        <td class="text-right">
                            <a href="{!! route('employees.show', $employee->id) !!}" class="btn btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
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
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection