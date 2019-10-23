<nav-template inline-template>
    <nav class="flex items-center justify-between flex-wrap text-teal-900 p-4 bg-white ">
        <div class="flex items-center flex-shrink-0 mr-6">
            <svg class="fill-current h-8 w-8 mr-2" width="54px" height="54px" viewBox="0 0 54 54" enable-background="new 0 0 54 54" xml:space="preserve"><path fill-rule="evenodd" clip-rule="evenodd" d="M53.445,28.595c-0.327,5.71-3.195,10.61-9.099,13.34 c-5.855,2.706-11.426,1.786-16.449-2.213c-1.18-0.938-2.152-2.14-3.251-3.187c-0.51-0.486-1.054-0.963-1.655-1.323 c-1.429-0.855-2.916-0.72-4.369-0.033c-1.235,0.585-2.428,1.265-3.678,1.816c-6.641,2.932-13.831-1.631-14.011-8.874 c-0.153-6.154,5.846-11.078,11.872-9.608c1.692,0.413,3.261,1.338,4.882,2.036c0.371,0.161,0.718,0.377,1.092,0.532 c2.105,0.871,3.806,0.474,5.361-1.205c1.187-1.281,2.309-2.64,3.61-3.793c7.153-6.337,18.573-4.466,23.43,3.759 C52.649,22.331,53.394,24.987,53.445,28.595z"/></svg>
            <a href=" {{ route('home')  }} ">
                <span class="font-semibold text-3xl tracking-tight"> Superlijm </span>
            </a>
        </div>
        <div class="block lg:hidden" @click="toggleHidden">
            <button class="flex items-center px-3 py-2 border rounded border-yellow-400 hover:text-black hover:border-white" >
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
            </button>
        </div>
        <div id="nav-content" class="w-full block flex-grow lg:flex lg:items-center lg:w-auto" :class="{'hidden' : isHidden}">
            <div class="text-sm lg:flex-grow">
                <a href="#responsive-header" class="block mt-4 lg:inline-block lg:mt-0 hover:text-black mr-4">
                    Docs
                </a>
                <a href="#responsive-header" class="block mt-4 lg:inline-block lg:mt-0 hover:text-black mr-4">
                    Examples
                </a>
            </div>
            <div class="border-t mt-8 text-center lg:border-0 lg:mt-0">
                @guest
                    <a href=" {{ route('login') }} " class="inline-block text-sm px-4 py-2 leading-none rounded hover:text-gray-800 hover:bg-gray-100"> Login </a>
                    <a href=" {{ route('register') }} " class="inline-block text-sm px-4 py-2 leading-none border rounded border-white hover:border-transparent hover:text-gray-800 hover:bg-white mt-4 lg:mt-0">Register</a>
                @else
                    <a class="inline-block text-sm px-4 py-2 leading-none rounded hover:text-gray-800 hover:bg-gray-100" href="#" >Beheer profiel</a>
                    <a class="inline-block text-sm px-4 py-2 leading-none rounded hover:text-gray-800 hover:bg-gray-100" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endguest
            </div>
        </div>
    </nav>
</nav-template>


