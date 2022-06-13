<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-content-dashboard>
        <div class="container">
            <div class="w-full lg:w-2/3 mx-auto px-4 mb-8">
                <div class="w-full mx-auto text-center mb-20">
                    <h2 class="font-bold text-dark text-3xl my-4 sm:text-4xl lg:text-3xl">All product</h2>
                </div>
                <div class="w-full mb-8">
                    <a href="{{ route('products.create') }}" class="py-2 px-4 bg-red-400 rounded-full text-white">Add new product</a>
                </div>
                @if (session('success'))
                    <div class="w-full mx-auto my-12">
                        <p class="py-2 px-4 bg-teal-300 rounded-full text-white">{{ session('success') }}</p>
                    </div>
                @endif
            </div>
            <div class="w-full lg:w-2/3 mx-auto">
                <div class="w-full px-4 mb-8 overflow-x-scroll lg:overflow-x-hidden">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="w-full bg-slate-500 text-white">
                                <th class="bg-slate-500 p-3 rounded-tl-xl">Name</th>
                                <th class="bg-slate-500 p-3">Price</th>
                                <th class="bg-slate-500 p-3">Description</th>
                                <th class="bg-slate-500 p-3 rounded-tr-xl">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="border-b border-slate-300 text-center">
                                    <td class="p-4">{{ $product->name }}</td>
                                    <td class="p-4">{{ $product->price }}</td>
                                    <td class="p-4">{{ substr($product->description, 0, 40)  }}</td>
                                    <td class="p-4 flex flex-wrap justify-center lg:flex-nowrap">
                                        <a href="{{ route('products.edit', $product->id) }}" class="w-full my-1 py-2 px-3 bg-yellow-400 rounded-full text-white lg:mx-1 ">Edit</a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full my-1 py-2 px-3 bg-red-500 rounded-full text-white lg:mx-1 ">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-content-dashboard>
</x-app-layout>
