<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/app.css">
</head>
<body class="bg-gradient-to-r from-slate-200 to-slate-300">

    <nav class="p-5 bg-white shadow md:flex md:items-center md:justify-between">
        {{-- <div class="grid grid-row-3 space-between w-full"> --}}
            <div class="flex justify-between items-center md:pl-7">
                <a href="index.html" class="text-2xl font-[Popp] cursor-pointer">
                    Bean
                </a>
                <div class="justify-between md:hidden">
                    <form action="" method="GET">
                        <input type="text" placeholder="search" class="w-9/12  max-w-sm bg-slate-100 border-none focus:ring-0 rounded-full">
                    </form>
                </div>
                <span class="text-3xl cursor-pointer md:hidden mx-2 block absolute right-3 top-[1.30rem]">
                    <button name="menu" onclick="Menu(this)" class="space-y-2" id="menu">
                        <span class="w-9 hamburger-items origin-top-left  transition-all duration-700"></span>
                        <span class="w-7 hamburger-items transition-all duration-500"></span>
                        <span class="w-5 hamburger-items origin-bottom-left transition-all duration-700"></span>
                    </button>
                </span>
            </div>
            <div class="flex justify-center lg:translate-x-28 items-center md:pl-7 w-full">
                <div class="md:block hidden w-8/12">
                    <form action="">
                        <input type="text" placeholder="search" class="hidden md:block mx-3 my-6 md:my-0 bg-slate-100 border-none focus:ring-0 rounded-full w-full">
                    </form>
                </div>
            </div>
            <ul class="pr-7 -translate-y-1 md:flex md:items-center md:z-auto md:static absolute w-full left-0 md:w-auto md:py-0 py-0 md:pl-0 pl-7 md:opacity-100 opacity-0 top-[-400px] transition-all ease-in duration-500">
                @guest
                    <li class="mx-3 md:scale-90 md:mx-0 lg:mx-3 lg:scale-110 my-6 md:my-0 group text-lg text-white font-semibold scale-110">
                        <a href="{{ route('register') }}" class="bg-red-300 rounded-full px-3 pb-2 pt-1">
                            Register
                        </a>
                    </li>
                    <li class="mx-3 md:scale-90 md:mx-0 lg:mx-3 lg:scale-110 my-6 md:my-0 group text-lg text-white font-semibold scale-110">
                        <a href="{{ route('login') }}" class="bg-red-300 rounded-full px-3 pb-2 pt-1">
                            Login
                        </a>
                    </li>
                @endguest
                @auth
                    @role('super-admin|seller')
                        <li class="mx-3 md:scale-90 md:mx-0 lg:mx-3 lg:scale-110 my-6 md:my-0 group text-lg text-white font-semibold scale-110">
                            <a href="#" class="bg-red-300 rounded-full px-3 pb-[0.55rem] pt-[0.4rem]">
                                Cart
                            </a>
                        </li>
                        <li class="mx-3 md:scale-90 md:mx-0 lg:mx-3 lg:scale-110 my-6 md:my-0 group text-lg text-white font-semibold scale-110">
                            <a href="{{ route('dashboard') }}" class="bg-red-300 rounded-full px-3 pb-[0.55rem] pt-[0.4rem]">
                                Dashboard
                            </a>
                        </li>
                        <li class="mx-3 md:scale-90 md:mx-0 lg:mx-3 lg:scale-110 my-6 md:my-0 group text-lg text-white font-semibold scale-110">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                @method('POST')
                                <button class="bg-red-300 rounded-full px-3 pb-2 pt-1">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="mx-3 md:scale-90 md:mx-0 lg:mx-3 lg:scale-110 my-6 md:my-0 group text-lg text-white font-semibold scale-110">
                            <a href="#" class="bg-red-300 rounded-full px-3 pb-[0.55rem] pt-[0.4rem]">
                                Cart
                            </a>
                        </li>
                        <li class="mx-3 md:scale-90 md:mx-0 lg:mx-3 lg:scale-110 my-6 md:my-0 group text-lg text-white font-semibold scale-110">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                @method('POST')
                                <button class="bg-red-300 rounded-full px-3 pb-2 pt-1">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @endrole
                @endauth
            </ul>
        {{-- </div> --}}
    </nav>
    
    {{-- search --}}

    {{-- Product menu --}}
    <div class="container mx-auto px-5 md:px-0 my-12">
        <h2 class="mb-32 mt-24 text-4xl text-center  font-semibold text-slate-800 md:text-5xl">Latest Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 px-3 md:px-6">
            @foreach ($products as $product)
            @if ($loop->iteration === 6)
                @break
            @endif
            <div class="w-full max-w-xs h-[30rem] mx-auto mb-2 rounded-lg shadow-lg overflow-hidden bg-slate-100">
                <img class="w-full h-72"
                    src="https://source.unsplash.com/300x400"
                    alt="product" />
                <div class="px-6 py-4">
                    <p class="leading-normal text-gray-700 text-sm font-semibold my-3">
                        <span class="rounded-full bg-slate-300 py-1 px-2">
                            {{ $product->category->name }}
                        </span>
                    </p>
                    <h4 class="text-lg font-semibold tracking-tight text-gray-800 my-2">{{ $product->name }}</h4>
                    <p class="leading-normal text-gray-700 text-2xl my-2">{{ $product->price }}</p>
                    <div class="flex">
                        <div class="w-1/2 text-start">
                            <p class="leading-normal text-gray-700 text-base my-2">{{ $product->user->name }}</p>
                        </div>
                        <div class="w-1/2 text-center bg-slate-200 rounded-full">
                            <p class="leading-normal text-gray-700 text-base my-2">
                                <a href="#">Add to cart</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <h2 class="mb-32 mt-40 text-4xl text-center font-semibold text-slate-800 md:text-5xl">All Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 px-3 md:px-6">
            @foreach ($products->skip(5) as $product)
            <div class="w-full max-w-xs h-[30rem]  mx-auto mb-2 rounded-lg shadow-lg overflow-hidden bg-slate-100">
                @foreach ($product->images as $images)
                    <img class="w-full h-72"
                    src="uploads/products/{{ $images->path }}"
                    alt="product" />
                @endforeach
                <div class="px-6 py-4">
                    <p class="leading-normal text-gray-700 text-sm font-semibold my-3">
                        <span class="rounded-full bg-slate-300 py-1 px-2">
                            {{ $product->category->name }}
                        </span>
                    </p>
                    <h4 class="text-lg font-semibold tracking-tight text-gray-800 my-2">{{ $product->name }}</h4>
                    <p class="leading-normal text-gray-700 text-2xl my-2">Price</p>
                    <div class="flex">
                        <div class="w-1/2 text-start">
                            <p class="leading-normal text-gray-700 text-base my-2">{{ $product->user->name }}</p>
                        </div>
                        <div class="w-1/2 text-center bg-slate-200 rounded-full">
                            <p class="leading-normal text-gray-700 text-base my-2">
                                <a href="#">Add to cart</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>


    <script src="js/hamburger.js"></script>
</body>
</html>