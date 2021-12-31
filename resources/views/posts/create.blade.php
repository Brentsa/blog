<x-layout>
    <section class="px-6 py-8">
        <x-panel class="max-w-lg mx-auto">
            <h1 class="font-bold text-lg mb-6">
                Publish a new blog post!
            </h1>
            <form method="POST" action="/admin/posts" class="space-y-4" enctype="multipart/form-data">
                @csrf

                <div>
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="title">
                        Title
                    </label>
                    <input 
                        class="border border-gray-400 p-2 w-full"
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title') }}"
                        required
                    />
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="slug">
                        Slug
                    </label>
                    <input 
                        class="border border-gray-400 p-2 w-full"
                        type="text"
                        name="slug"
                        id="slug"
                        value="{{ old('slug') }}"
                        required
                    />
                    @error('slug')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="thumbnail">
                        Thumbnail
                    </label>
                    <input 
                        class="border border-gray-400 p-2 w-full"
                        type="file"
                        name="thumbnail"
                        id="thumbnail"
                        value="{{ old('thumbnail') }}"
                        required
                    />
                    @error('thumbnail')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="excerpt">
                        Excerpt
                    </label>
                    <textarea 
                        name="excerpt" 
                        id="excerpt" 
                        class="border border-gray-400 p-2 w-full"
                        required
                    >{{ old('excerpt') }}</textarea>
    
                    @error('excerpt')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="body">
                        Body
                    </label>
                    <textarea 
                        name="body" 
                        id="body" 
                        class="border border-gray-400 p-2 w-full"
                        required
                    >{{ old('body') }}</textarea>
    
                    @error('body')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="category_id">
                        Category
                    </label>
                    <select name="category_id" id="category">
                        @php
                            $categories = App\Models\Category::all();
                        @endphp
                        @foreach ($categories as $category)
                            <option 
                                value="{{$category->id}}"
                                {{old('category_id') == $category->id ? 'selected' : ''}}
                            >
                                {{ ucwords($category->name)}}
                            </option>    
                        @endforeach
                    </select>
    
                    @error('category_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <x-submit-button>Publish</x-submit-button>
            </form>
        </x-panel>
    </section>
</x-layout>