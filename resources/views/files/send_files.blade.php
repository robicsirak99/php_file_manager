
@extends('index')

@section('content')
    @csrf
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-5">
            <div class="mb-4">
                @if(session('status'))
                    <div class="bg-red-500 mb-6 text-white text-center">
                        {{session('status')}}
                    </div>
                @endif
                @if(session('status_1'))
                    <div class="bg-green-500 mb-6 text-white text-center">
                        {{session('status_1')}}
                    </div>
                @endif
                <form action="{{route('send_files')}}" method="post" class="pr-2">
                @if($files->count())
                    @foreach($files as $file)
                    <div class="mb-4 justify-between flex flex-row" >
                        <div class=" flex flex-row">

                            <div class="px-1">
                                <input type="checkbox" name="file_list[]" value={{$file->id}}>
                            </div>

                            <div class="px-2">{{substr($file->file_name,13)}}</div>
                            <div class="px-2">{{$file->file_size . ' byte'}}</div>
                        
                        </div>
                    </div>
                    @endforeach
                @else
                    There are no files uploaded.
                @endif
                @csrf
                <button type="submit" class=" bg-blue-500 text-white p-2 inset-y-0 right-0">Send these files</button>
                    <label>To</label>
                    <input type="text" name="username" id="username" placeholder="Username" class="bg-gray-100 border-2 p-2">
                    @error('username')
                        <div class="text-red-500 tx-small">{{$message}}</div>
                    @enderror
                </form>
            </div>    
        </div>
    </div>
@endsection


