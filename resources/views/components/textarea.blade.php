@props([
        'labelName' => '', 
        'name' => '',
        'id' =>'',
        'row' => 4,
        'placeholder' => ''
])

<label for="{{ $id }}" class="block text-sm font-medium text-gray-700 mb-1">{{ $labelName }}</label>
<textarea name="{{ $name }}" id="{{ $id }}" rows="4" 
    class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
    placeholder="{{ $placeholder }}">{{ $slot }}
</textarea>

@error($name)
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
@enderror