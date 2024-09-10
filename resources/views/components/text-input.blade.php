@props([
    'disabled' => false,
    'name' => null,
    'label' => null
])

@if ($label)
    <x-input-label
        :for="$name"
        :value="__($label)"
        class="block mt-1 text-sm font-medium text-gray-700 dark:text-gray-300"
    />
@endif
<input
    name="{{ $name }}"
    id="{{ $name }}"
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) !!}
>
<x-input-error :messages="$errors->get($name) ? $errors->get($name) : $errors->get('form.'.$name)" class="mt-2"/>
