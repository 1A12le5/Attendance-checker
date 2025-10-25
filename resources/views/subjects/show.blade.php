@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Subject Details</h1>
    </div>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <!-- Subject Name -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Subject Name</label>
                <p class="mt-2 text-lg font-semibold text-gray-900 dark:text-white">{{ $subject->name }}</p>
            </div>

            <!-- Subject Code -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Subject Code</label>
                <p class="mt-2 text-lg text-gray-900 dark:text-white">
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full font-mono">{{ $subject->code }}</span>
                </p>
            </div>

            <!-- Subject Description -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                <p class="mt-2 text-lg text-gray-900 dark:text-white">
                    @if($subject->description)
                        {{ $subject->description }}
                    @else
                        <span class="text-gray-500 italic">No description provided</span>
                    @endif
                </p>
            </div>

            <!-- Created Date -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Created Date</label>
                <p class="mt-2 text-lg text-gray-900 dark:text-white">{{ $subject->created_at->format('M d, Y') }}</p>
            </div>

            <!-- Updated Date -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Updated</label>
                <p class="mt-2 text-lg text-gray-900 dark:text-white">{{ $subject->updated_at->format('M d, Y H:i A') }}</p>
            </div>

            <!-- Subject Information Card -->
            <div class="bg-blue-50 dark:bg-blue-900 border border-blue-200 dark:border-blue-700 rounded-lg p-4 mb-6">
                <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-100 mb-2">Subject Information</h3>
                <ul class="text-blue-800 dark:text-blue-200 space-y-1">
                    <li><strong>ID:</strong> {{ $subject->id }}</li>
                    <li><strong>Status:</strong> <span class="text-green-600 font-semibold">Active</span></li>
                </ul>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4 mt-8">
                <a href="{{ route('subjects.edit', $subject) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                    Edit Subject
                </a>
                <a href="{{ route('subjects.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                    Back to List
                </a>
                <form action="{{ route('subjects.destroy', $subject) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-6 rounded" onclick="return confirm('Are you sure?')">
                        Delete Subject
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

