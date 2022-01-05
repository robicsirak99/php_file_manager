@extends('index')

@section('content')
    @csrf
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-5">
            <form action="{{route('save_created_text_file')}}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="name" class="sr-only">Name</label>
                    <input type="text" name="name" id="name" placeholder="Name"
                        class="bg-gray-100 border-2 w-full p-4">
                    @error('name')
                        <div class="text-red-500 tx-small">{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="body" class="sr-only">Body</label>
                    <textarea name="body" id="body" cols="30" rows="10" class="bg-gray-100 border-2 w-full p-4"></textarea>

                    @error('body')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection