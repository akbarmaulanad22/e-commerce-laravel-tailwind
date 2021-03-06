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
                    <h2 class="font-bold text-dark text-3xl my-4 sm:text-4xl lg:text-3xl">All category</h2>
                </div>
                <div class="w-full mb-10 lg:text-start flex">
                    <div class="mx-auto w-1/2">
                        <a href="{{ route('categories.create') }}" class="inline-block py-2 px-4 bg-red-400 rounded-full text-white">Add new category</a>
                    </div>
                    <div class="mx-auto w-1/2 flex">
                        <form action="{{ route('categories.index') }}" method="GET">
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
                @if ($categories->count() > 0)
                    <div class="w-full px-4 mb-8 overflow-x-scroll lg:overflow-x-hidden">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="w-full bg-slate-500 text-white">
                                    <th class="bg-slate-500 p-3 rounded-tl-xl">Name</th>
                                    <th class="bg-slate-500 p-3 rounded-tr-xl">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr class="border-b border-slate-300">
                                        <td class="p-4 text-center">{{ $category->name }}</td>
                                        <td class="p-4 text-center lg:flex items-center lg:justify-center">
                                            <div class="my-1">
                                                <a href="{{ route('categories.edit', $category->id) }}" class="my-1 py-2 px-[1.40rem] bg-yellow-400 rounded-full text-white lg:mx-1 ">Edit</a>
                                            </div>
                                            <div class="my-1">
                                                <a href="{{ route('categories.show', $category->id) }}" class="my-1 py-2 px-[1.40rem] bg-sky-400 rounded-full text-white lg:mx-1 ">Show</a>
                                            </div>
                                            <div class="my-1">
                                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
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
                        <div class="w-full bg-slate-200 rounded-xl text-2xl font-semibold text-center py-2 mx-auto">
                            No category
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </x-content-dashboard>
</x-app-layout>
