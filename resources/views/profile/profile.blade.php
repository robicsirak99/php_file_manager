@extends('index')

@section('content')
    @csrf
    <div class="flex justify-center">
        <div class="w-5/12 bg-white p-5 ">
            @if(session('status'))
                <div class="bg-green-500 mb-6 text-white text-center">
                    {{session('status')}}
                </div>
            @endif
            <div class="justify-between flex flex-row p-1">
                <div>Name: {{auth()->user()->name}}</div>
            </div>
            <div class="justify-between flex flex-row p-1">
                <div>Email: {{auth()->user()->email}}</div>
            </div>
            <div class="justify-between flex flex-row p-1">
                <div>Username: {{auth()->user()->username}}</div>
                <form action="{{route('change_username')}}" method="get" class="pr-2">
                     @csrf
                    <button type="submit" class=" bg-blue-500 text-white px-2 inset-y-0 right-0">Chnage</button>
                </form>
            </div>
            <div class="justify-between flex flex-row p-1">
                <div>Password</div>
                <form action="{{route('change_password')}}" method="get" class="pr-2">
                     @csrf
                    <button type="submit" class=" bg-blue-500 text-white px-2 inset-y-0 right-0">Chnage</button>
                </form>
            </div>
        </div>
    </div>
@endsection