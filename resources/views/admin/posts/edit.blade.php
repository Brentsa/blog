<x-layout>
    <x-setting heading="Edit Post - {{$post->title}}">
        <form method="POST" action="/admin/posts/{{$post->id}}" class="space-y-4" enctype="multipart/form-data">
            @csrf
            @method("PATCH")

            <x-form.input name="title" :value="$post->title"/>
            <x-form.input name="slug" :value="$post->slug"/>
            
            <div class="flex justify-between">
                <div class="flex-1">
                    <x-form.input name="thumbnail" type="file" :value="$post->thumbnail"/>
                </div>
                <img src="{{asset('storage/' . $post->thumbnail)}}" alt="" class="rounded-xl ml-4" width="100"/>
            </div>
            

            <x-form.textarea name="excerpt">{{$post->excerpt}}</x-form.textarea>
            <x-form.textarea name="body">{{$post->body}}</x-form.textarea>

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
                            {{old('category_id', $post->category_id) == $category->id ? 'selected' : ''}}
                        >
                            {{ ucwords($category->name)}}
                        </option>    
                    @endforeach
                </select>
                <x-form.error name="category_id"/>
            </div>

            <x-form.button>Update</x-form.button>
        </form>
    </x-setting>
</x-layout>