@props(['heading'])
<section class="px-6 py-8 max-w-3xl mx-auto">
    <h1 class="font-bold text-lg mb-6 py-2 border-b">
        {{$heading}}
    </h1>

    <main class="flex">
        <aside class="w-48">
            <h4 class="font-semibold mb-4">Links</h4>
            <ul>
                <li>
                    <a href="/admin/posts/create" class="{{request()->is('admin/posts/create') ? 'text-blue-500' : ''}}">New Post</a>
                </li>
            </ul>
        </aside>
    
        <x-panel class="flex-1">
            {{$slot}}
        </x-panel>
    </main>
</section>