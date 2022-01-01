@props(['name'])
<div>
    <x-form.label :name="$name"/>
    <textarea 
        name="{{$name}}" 
        id="{{$name}}" 
        class="border border-gray-300 p-2 w-full rounded"
        required
    >{{ old($name) }}</textarea>
    <x-form.error :name="$name"/>
</div>