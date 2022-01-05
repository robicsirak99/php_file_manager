<nav class="p-5 bg-white flex justify-between mb-5 ">
    <ul class="flex items-center divide-x">
                <li class="px-1"> 
                    <a href="{{route('home')}}" class="p-3">Home</a>
                </li>
                <li class="px-1"> 
                    <a href="{{route('files')}}" class="p-3">Files</a>
                </li>
                <li class="px-1"> 
                    <a href="{{route('send_files')}}" class="p-3">Send Files</a>
                </li>
            </ul>

            <ul class="flex items-center divide-x">

                @auth
                <li class="px-1">
                    <a href="{{route('profile')}}" class="p-3">{{auth()->user()->username}}</a>
                </li>
                <li class="px-1">
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit" class="p-3">Logout</button>
                    </form>
                </li>
                @endauth

                @guest
                <li class="px-1">
                    <a href="{{route('login')}}" class="p-3">Login</a>
                </li>
                <li class="px-1">
                    <a href="{{route('register')}}" class="p-3">Register</a>
                </li>
                @endguest

            </ul>
        </nav>