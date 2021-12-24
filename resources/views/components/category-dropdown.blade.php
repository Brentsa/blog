<x-dropdown>
    <!-- dropdown menu button -->
    <x-slot name="trigger">
        <button class="flex-1 appearance-none bg-transparent py-2 pl-3 text-sm text-left font-semibold w-full lg:w-32 flex lg:inline-flex">
            {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories'}}

            <x-down-arrow-svg class="absolute pointer-events-none" style="right: 12px;"/>
        </button>
    </x-slot>

    <!-- Dropdown Items List -->
    <x-dropdown-item 
        href="/?{{http_build_query(request()->except('category', 'page'))}}" 
        :active="!request('category')"
    >
        All
    </x-dropdown-item>
    @foreach ($categories as $category)
        <x-dropdown-item 
            {{-- take the request queries except category, and build them as a string --}}
            href="/?category={{$category->slug}}&{{http_build_query(request()->except('category', 'page'))}}" 
            :active="isset($currentCategory) && $currentCategory->is($category)"
        >
            {{ucwords($category->name)}}
        </x-dropdown-item>
    @endforeach
</x-dropdown>