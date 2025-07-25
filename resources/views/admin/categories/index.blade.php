@extends('layouts.app')

@section('content')

<div class="bg-white p-6 rounded-2xl shadow-md max-w-4xl mx-auto my-10">
    <!-- Header -->
    <div class="flex justify-between items-center mb-5">
        <h2 class="text-xl font-semibold flex items-center gap-2">
            List All Categories
        </h2>
        <button 
            type="button" 
            data-modal-target="default-modal" 
            data-modal-toggle="default-modal" 
            data-action="{{ route('admin.categories.store') }}"
            data-title="Add New Category"
            data-method="POST"
            class="bg-indigo-500 hover:bg-indigo-600 text-white text-sm px-4 py-2 rounded-lg flex items-center gap-1 shadow"
            
        >
            ➕ Add Category
        </button>
    </div>

    <!-- Category List -->
    <div class="space-y-4">
        @forelse ($categories as $category)
        <div class="bg-gray-50 p-4 rounded-xl shadow-sm flex justify-between items-center">
            <div>
                <h3 class="font-semibold text-gray-800">{{ $category->name }}</h3>
            </div>
            <div class="flex gap-2">
                <button type="button" 
                    data-modal-target="default-modal"
                    data-modal-toggle="default-modal"
                    data-action="{{ route('admin.categories.update', $category) }}"
                    data-method="PUT"
                    data-title="Edit Category"
                    data-submit="Update"
                    data-name="{{ $category->name }}"

                   class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1.5 rounded-lg text-xs font-medium shadow">
                    ✏️ Edit
                </button>
                {{-- 
                <form action="{{ route('admin.categories.destroy', $categories) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium shadow">
                        🗑️ Delete
                    </button>
                </form>
                --}}
            </div>
        </div>
        @empty
        <div class="text-gray-500 text-sm text-center py-6">
            No categories found.
        </div>
        @endforelse
    </div>
</div>




<!-- Main modal -->
<div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 id="modal-title" class="text-xl font-semibold text-gray-900 ">
                    Add New Category
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form method="POST" id="frm-category">
                @csrf
                <div class="p-4 md:p-5 space-y-4">
                    <x-input labelName="Name"  name="name"  />
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button 
                        
                    data-modal-hide="default-modal" id="modal-submit-button" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add New</button>
                    <button data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@section('scripting')
<script>
    document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('default-modal');
    const form = document.getElementById('frm-category');
    const methodInput = document.getElementById('form-method');
    const nameInput = form.querySelector('[name="name"]');
    const title = document.getElementById('modal-title');
    const submitBtn = document.getElementById('modal-submit-button');

    document.querySelectorAll('[data-modal-toggle="default-modal"]').forEach(button => {
        button.addEventListener('click', () => {
            const action = button.getAttribute('data-action');
            const method = button.getAttribute('data-method') || 'POST';
            const name = button.getAttribute('data-name') || '';
            const modalTitle = button.getAttribute('data-title') || 'Add New Category';
            const submitText = button.getAttribute('data-submit') || 'Add';

            form.action = action;
            if(methodInput) methodInput.value = method;
            if(nameInput) nameInput.value = name;
            if(title) title.textContent = modalTitle;
            if(submitBtn) submitBtn.textContent = submitText;
        });
    });
});

</script>
@endsection
