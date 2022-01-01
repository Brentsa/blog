@props(['name'])
<div>
    <x-form.label :name="$name"/>
    <input 
        class="border border-gray-300 p-2 w-full rounded"
        name="{{$name}}"
        id="{{$name}}"
        value="{{ old($name) }}"
        required
        {{$attributes}}
    />
    <x-form.error :name="$name"/>
</div>