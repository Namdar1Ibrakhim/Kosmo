@extends('block')

@section('content')
    <div style = "width:100%; height:100px; display:flex;justify-content:center; flex-direction: column; text-align:center; padding-top:270px;">



        <div style = "margin:auto;  display:flex;justify-content:center; flex-direction: column;" >

            <div style="display: flex">
                <div style = "padding:10px"><a href = "/private/createuser" method = "post" type="submit" class="btn btn-success" style = "color:white;padding:10px">Зарегестрировать пользователя</a></div>
                <div style = "padding:10px"><a href = "roles/index" method = "post" type="submit" class="btn btn-warning" style = "color:white;padding:10px">Роли</a></div>
            </div>


        @if(count($data)==0)
                <h3>Нет пользователей</h3>
            @else
                <h3>Все Пользователи</h3>
            @endif

            @foreach($data as $el)
                <div class = "alert alert-info" style="width:800px">
                    <h5>Role: {{$el->getRoleNames()}}</h5>

                    <h5>Name: {{ $el->name}}</h5>
                    <h5>Email: {{ $el->email}}</h5>
                    <h5>Password: {{ $el->password}}</h5>

                    <a href = "/private/edituser/{{$el->id}}" method = "post" type="submit" class="btn btn-warning" style = "color:white">Редактировать</a>
                    <a href = "/private/deleteuser/{{$el->id}}" methond = "post" type="submit" class="btn btn-danger" style = "color:white">Удалить</a>
                </div>
                @error('all')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            @endforeach


        </div>

    </div>

@endsection
