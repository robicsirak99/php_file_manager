@extends('index')

@section('content')
    <div class="flex justify-center">
        <div class="w-3/12 bg-white p-5">

            @if(session('status'))
                <div class="bg-red-500 mb-6 text-white text-center">
                    {{session('status')}}
                </div>
            @endif

            <form action="{{route('change_password')}}" method="post">
                
                @csrf
                <div class="mb-4">
                    <label for="password_old" class=sr-only>Old Password</label>
                    <input type="password" name="password_old" id="password_old" placeholder="Old Password" 
                        class="bg-gray-100 border-2 w-full p-4">
                    @error('password_old')
                        <div class="text-red-500 tx-small">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_new" class=sr-only>New Password</label>
                    <input type="password" name="password_new" id="password_new" placeholder="New Password" 
                        class="bg-gray-100 border-2 w-full p-4" value="">
                    @error('password_new')
                        <div class="text-red-500 tx-small">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_new_confirmation" class=sr-only>New Password Again</label>
                    <input type="password" name="password_new_confirmation" id="password_new_confirmation" placeholder="Repeat your new password" 
                        class="bg-gray-100 border-2 w-full p-4" value="">
                </div>


                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 w-full">Chnage Password</button>
                </div>

            </form>
        </div>
    </div>
@endsection