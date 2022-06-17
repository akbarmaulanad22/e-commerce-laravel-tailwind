<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-content-dashboard>
        <div class="container">
            <div class="w-full lg:w-2/3 mx-auto px-4 mb-20">
                <div class="w-full mx-auto text-center mb-20">
                    <h2 class="font-bold text-dark text-3xl my-4 sm:text-4xl lg:text-3xl">All product</h2>
                </div>
                <div class="w-full mb-10 lg:text-start flex">
                    <div class="mx-auto w-1/2">
                        <a href="{{ route('products.create') }}" class="inline-block py-2 px-4 bg-red-400 rounded-full text-white">Add new product</a>
                    </div>
                    <div class="mx-auto w-1/2 flex">
                        <form action="{{ route('products.index') }}" method="GET">
                            <input type="text" placeholder="Name" name="name"  class="py-2 px-4 rounded-full focus:placeholder:opacity-0 transition-all duration-500" value="{{ old('productName') ?? '' }}">
                            <button type="submit" class="py-2 px-4 bg-teal-400 rounded-full text-white">Search</button>
                        </form>
                    </div>
                </div>
                @if (session('success'))
                    <div class="w-full mx-auto my-12">
                        <p class="py-2 px-4 bg-teal-300 rounded-full text-white">{{ session('success') }}</p>
                    </div>
                @endif
            </div>
            <div class="w-full lg:w-2/3 mx-auto px-4 mb-8">
                @if ($products->count() > 0)
                    <div class="w-full overflow-x-scroll lg:overflow-x-hidden">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="w-full bg-slate-500 text-white">
                                    <th class="bg-slate-500 p-3 rounded-tl-xl">Name</th>
                                    <th class="bg-slate-500 p-3">Category</th>
                                    <th class="bg-slate-500 p-3">Price</th>
                                    <th class="bg-slate-500 p-3">Size</th>
                                    <th class="bg-slate-500 p-3">Description</th>
                                    <th class="bg-slate-500 p-3 rounded-tr-xl">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr class="border-b border-slate-300">
                                        <td class="p-4 text-center">{{ $product->name }}</td>
                                        <td class="p-4 text-center">{{ $product->category->name }}</td>
                                        <td class="p-4 text-center">{{ $product->price }}</td>
                                        <td class="p-4 text-center">
                                            @foreach ($product->sizes as $sizes)
                                                @if ($loop->last)
                                                    {{ $sizes->size }}
                                                @else
                                                    {{ $sizes->size }},
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="p-4 text-center">{{ substr($product->description, 0, 40)  }}</td>
                                        <td class="p-4 text-center lg:flex items-center lg:justify-center">
                                            <div class="my-2">
                                                <a href="{{ route('products.edit', $product->id) }}" class="my-1 py-[0.58rem] px-[1.40rem] bg-yellow-400 rounded-full text-white lg:mx-1 ">Edit</a>
                                            </div>
                                            <div class="my-2">
                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="my-1 py-2 px-3 bg-red-500 rounded-full text-white lg:mx-1 ">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="w-full mx-auto">
                        <div class="w-full bg-slate-200 rounded-lg text-2xl font-semibold text-center py-2 mx-auto">
                            No product
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </x-content-dashboard>
</x-app-layout>
