<x-layout>
    <section class="px-6 py-8">
        <x-panel class="max-w-lg mx-auto">
            <h1 class="font-bold text-lg mb-6">
                Publish a new blog post!
            </h1>
            <form method="POST" action="/admin/posts" class="space-y-4" enctype="multipart/form-data">
                @csrf

                <x-form.input name="title"/>
                <x-form.input name="slug"/>
                <x-form.input name="thumbnail" type="file"/>
                <x-form.textarea name="excerpt"/>
                <x-form.textarea name="body"/>

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
                    <x-form.error name="category_id"/>
                </div>

                <x-form.button>Publish</x-form.button>
            </form>
        </x-panel>
    </section>
</x-layout>