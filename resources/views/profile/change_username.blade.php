@extends('index')

@section('content')
    <div class="flex justify-center">
        <div class="w-3/12 bg-white p-5">

            @if(session('status'))
                <div class="bg-red-500 mb-6 text-white text-center">
                    {{session('status')}}
                </div>
            @endif

            <form action="{{route('change_username')}}" method="post">
                
                @csrf
                <div class="mb-4">
                    <label for="username_old" class=sr-only>Old Username</label>
                    <input type="text" name="username_old" id="username_old" placeholder="Old Username" 
                        class="bg-gray-100 border-2 w-full p-4">
                    @error('username_old')
                        <div class="text-red-500 tx-small">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="username_new" class=sr-only>New Username</label>
                    <input type="text" name="username_new" id="username_new" placeholder="New Username" 
                        class="bg-gray-100 border-2 w-full p-4">
                    @error('username_new')
                        <div class="text-red-500 tx-small">{{$message}}</div>
                    @enderror
                </div>


                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 w-full">Chnage Username</button>
                </div>

            </form>
        </div>
    </div>
@endsection