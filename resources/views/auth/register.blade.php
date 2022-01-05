@extends('index')

@section('content')
    <div class="flex justify-center">
        <div class="w-3/12 bg-white p-5">

            @if(session('status'))
                <div class="bg-red-500 mb-6 text-white text-center">
                    {{session('status')}}
                </div>
            @endif

            <form action="{{route('register')}}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="name" class=sr-only>Name</label>
                    <input type="text" name="name" id="name" placeholder="Your name" 
                        class="bg-gray-100 border-2 w-full p-4" value="{{old('name')}}">
                    @error('name')
                        <div class="text-red-500 tx-small">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="username" class=sr-only>Username</label>
                    <input type="text" name="username" id="username" placeholder="Username" 
                        class="bg-gray-100 border-2 w-full p-4" value="{{old('username')}}">
                    @error('username')
                        <div class="text-red-500 tx-small">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class=sr-only>Email</label>
                    <input type="text" name="email" id="email" placeholder="Email" 
                        class="bg-gray-100 border-2 w-full p-4" value="{{old('email')}}">
                    @error('email')
                        <div class="text-red-500 tx-small">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class=sr-only>Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" 
                        class="bg-gray-100 border-2 w-full p-4" value="">
                    @error('password')
                        <div class="text-red-500 tx-small">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class=sr-only>Password again</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repeat your password" 
                        class="bg-gray-100 border-2 w-full p-4" value="">
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 w-full">Register</button>
                </div>

            </form>
        </div>
    </div>
@endsection