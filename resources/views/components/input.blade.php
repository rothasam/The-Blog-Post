@props(['labelName',
        'type' => 'text',
        'id' => '',
        'name' => '',
        'value' =>'',
        'placeholder' => '',
        ])

<div>

    @if($labelName)
        <label 
            for="{{ $id }}"
            {{ $attributes->merge([
                'class' => 'block text-sm font-medium text-gray-700 mb-1'
            ]) }}
        >
            {{ $labelName }}
        </label>
    @endif

    <input 
          type="{{ $type }}"
          name="{{ $name }}"
          id="{{ $id }}"
          value="{{ $value }}"
          placeholder="{{ $placeholder }}"
          {{ $attributes->merge([
            'class' => 'w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150'
            ]) }}
    >

    @error($name)
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>