<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-content-dashboard>
        <div class="container">
            <div class="w-full px-4">
                <div class="max-w-xl mx-auto text-center mb-16">
                  <h2 class="font-bold text-dark text-3xl my-4 sm:text-4xl lg:text-3xl">Create new product</h2>
                </div>
            </div>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="w-full px-4 lg:w-2/3 mx-auto">
                    <div class="w-full px-4 mb-8 pt-4 flex relative">
                        <input type="text" placeholder="Name"  name="name" id="name"  class="w-full bg-slate-200 peer placeholder:font-semibold placeholder:text-red-400  text-dark p-3 rounded-md border-none focus:ring-0 focus:placeholder:opacity-0 transition-all duration-500" value="{{ old('name') ?? '' }}">
                        <label for="name" class="opacity-0 scale-0 font-bold absolute translate-y-3 translate-x-3 peer-focus:-translate-y-7 peer-focus:opacity-100 peer-focus:scale-100 transition-all duration-200  text-red-400 after:content-['*'] after:ml-0.5 after:text-red-700">Name</label>
                        @error('name')
                            <p class="absolute text-red-500 pb-3 font-bold translate-y-12 translate-x-3">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="w-full px-4 mb-8 pt-4 flex relative">
                        <input type="file" name="image[]"  class="w-full bg-slate-200 peer placeholder:font-semibold placeholder:text-red-400  text-dark p-3 rounded-md border-none focus:ring-0 focus:placeholder:opacity-0 transition-all duration-500 text-sm text-slate-500
                                                    file:mr-4 file:py-2 file:px-4
                                                    file:rounded-full file:border-0
                                                    file:text-sm file:font-semibold
                                                    file:bg-violet-50 file:text-violet-700
                                                    hover:file:bg-violet-100
                                                    " multiple/>
                        <label for="image[]" class="opacity-0 scale-0 font-bold absolute translate-y-3 translate-x-3 peer-focus:-translate-y-7 peer-focus:opacity-100 peer-focus:scale-100 transition-all duration-200  text-red-400 after:content-['*'] after:ml-0.5 after:text-red-700">Image</label>
                        @error('image')
                            <p class="absolute text-red-500 py-3 font-bold translate-y-12 translate-x-3">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="w-full px-4 mb-8 pt-4 flex relative">
                        <select class="w-full bg-slate-200 peer placeholder:font-semibold placeholder:text-red-400  text-dark p-3 rounded-md border-none focus:ring-0 focus:placeholder:opacity-0 transition-all duration-500" name="category_id">
                            <option selected disabled>Choose category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="absolute text-red-500 pb-3 font-bold translate-y-12 translate-x-3">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="w-full px-4 mb-8 pt-4 flex relative">
                        <select multiple class="w-full bg-slate-200 peer placeholder:font-semibold placeholder:text-red-400  text-dark p-3 rounded-md border-none focus:ring-0 focus:placeholder:opacity-0 transition-all duration-500" name="size[]">
                            @foreach ($sizes as $size)
                                <option value="{{ $size->id }}"
                                >{{ $size->size }}</option>
                            @endforeach
                        </select>
                        @error('size')
                            <p class="absolute text-red-500 pb-3 font-bold translate-y-12 translate-x-3">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="w-full px-4 mb-8 pt-4 flex relative">
                        <input type="number" placeholder="Price" name="price" id="price=" class="w-full bg-slate-200 peer placeholder:font-semibold placeholder:text-red-400  text-dark p-3 rounded-md border-none focus:ring-0 focus:placeholder:opacity-0 transition-all duration-500" value="{{ old('price') ?? '' }}">
                        <label for="price" class="opacity-0 scale-0 font-bold absolute translate-y-3 translate-x-3 peer-focus:-translate-y-7 peer-focus:opacity-100 peer-focus:scale-100 transition-all duration-200  text-red-400 after:content-['*'] after:ml-0.5 after:text-red-700">Price</label>
                        @error('price')
                            <p class="absolute text-red-500 pb-3 font-bold translate-y-12 translate-x-3">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="w-full px-4 mb-14 pt-4 flex relative">
                        <textarea type="text" placeholder="Description"  name="description" id="description" class="w-full bg-slate-200 peer placeholder:font-semibold placeholder:text-red-400  text-dark p-3 rounded-md border-none focus:ring-0 focus:placeholder:opacity-0 transition-all duration-500">{{ old('description') ?? '' }}</textarea>
                        <label for="description" class="opacity-0 scale-0 font-bold absolute translate-y-3 translate-x-3 peer-focus:-translate-y-7 peer-focus:opacity-100 peer-focus:scale-100 transition-all duration-200  text-red-400 after:content-['*'] after:ml-0.5 after:text-red-700">Description</label>
                        @error('description')
                            <p class="absolute text-red-500 pb-3 font-bold translate-y-[4.4rem] translate-x-3">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="w-full px-4 mb-8 lg:mx-auto">
                        <button type="submit" class="w-full bg-red-300 py-2 text-slate-50  px-5 rounded-full">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </x-content-dashboard>
</x-app-layout>
