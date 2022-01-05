@component('mail::message')
# Files Recieved

You have recieved the following files:
@foreach($file_name_list as $file_name)
    <br>
    {{$file_name}}
@endforeach

From: 
{{$username}}

@endcomponent
