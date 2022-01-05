@extends('index')

@section('content')
    @csrf
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-5">

            <div class="mb-10 flex flex-wrap justify-between">
                <div class="">
                    <form method="post" action="{{route('files')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-3">Upload File</button>
                            
                            @error('file')
                            <div class="text-red-500 tx-small">{{$message}}</div>
                            @enderror

                    </form>
                </div>

                <div class="mt-3">
                    <a href="{{route('show_index_of_create_text_file')}}" class="bg-blue-500 text-white px-4 py-3 w-full">Create a text file</a>
                </div>
            </div>

            <div>
                <form action="{{route('files')}}" method="get" class="flex flex-row">
                    @csrf
                    <div class="mb-4 px-2">
                        <label for="string" class=sr-only>String</label>
                        <input type="text" name="string" id="string" placeholder="String" 
                            class="bg-gray-100 border-2 p-2" value="">
                        @error('string')
                            <div class="text-red-500 tx-small">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Search</button>
                    </div>

                </form>
            </div>

            <div class="mb-4">
                @if($files->count())
                    @foreach($files as $file)
                    <div class="mb-4 justify-between flex flex-row" >
                        
                        <div class=" flex flex-row">
                            <div class="px-2">{{$file->updated_at}}</div>
                            <div class="px-2">{{substr($file->file_name,13)}}</div>
                            <div class="px-2">{{$file->file_size . ' byte'}}</div>
                            <div class="px-2">{{$file->recieved_from}}</div>
                        </div>
                        
                        <div class=" flex flex-row">

                            @if(str_ends_with($file->file_name,'.txt'))
                            <form action="{{route('show_index_of_edit_text_file', $file)}}" method="get" class="pr-2">
                                @csrf
                                <button type="submit" class=" bg-blue-500 text-white px-2 inset-y-0 right-0">Edit</button>
                            </form>
                            @else
                            @endif

                            <form action="{{route('files.destroy', $file)}}" method="post" class="pr-2">
                                @csrf
                                @method('delete')
                                <button type="submit" class=" bg-blue-500 text-white px-2 inset-y-0 right-0">Delete</button>
                            </form>
                            <form action="{{route('files.download', $file)}}" method="get">
                                @csrf
                                <button type="submit" class=" bg-blue-500 text-white px-2 inset-y-0 right-0">Dowload</button>
                            </form>
                        </div>

                    </div>
                    @endforeach
                @else
                    There are no files uploaded.
                @endif
            </div>    

            <div class="flex flex-row">            
                <div class="px-2">
                    <form action="{{route('files')}}" method="get" class="flex flex-row">
                        @csrf
                        <input type="hidden" name="previous" id="previous" value="previous">
                        <input type="hidden" name="current_page" id="current_page" value={{$current_page}}>
                        <input type="hidden" name="string" id="string" value={{$searching_for}}>
                        <button type="submit" class="bg-blue-500 text-white px-2 py-1">Previous Page</button>
                    </form>
                </div>
                <div>
                    <form action="{{route('files')}}" method="get" class="flex flex-row">
                        @csrf
                        <input type="hidden" name="next" id="next" value="next">
                        <input type="hidden" name="current_page" id="current_page" value={{$current_page}}>
                        <input type="hidden" name="string" id="string" value={{$searching_for}}>
                        <button type="submit" class="bg-blue-500 text-white px-2 py-1">Next Page</button>
                    </form>
                </div>
                <div class="px-2">
                    Total Pages: {{$total_pages}}
                </div>
                <div class="px-2">
                    Current Page: {{$current_page + 1}}
                </div>
                <div class="">
                    <form action="{{route('files')}}" method="get" class="flex flex-row">
                        @csrf
                        <input type="hidden" name="sort_by_date" id="sort_by_date" value="sort_by_date">
                        <input type="hidden" name="current_page" id="current_page" value={{$current_page}}>
                        <input type="hidden" name="string" id="string" value={{$searching_for}}>
                        <button type="submit" class="bg-blue-500 text-white px-2 py-1">Sort By Date</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection