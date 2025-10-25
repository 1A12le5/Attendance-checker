@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Attendance Record Details</h1>
    </div>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <!-- Attendance ID -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Record ID</label>
                <p class="mt-2 text-lg font-semibold text-gray-900 dark:text-white">#{{ $attendance->id }}</p>
            </div>

            <!-- Student Name -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Student Name</label>
                <p class="mt-2 text-lg text-gray-900 dark:text-white">
                    <a href="{{ route('students.show', $attendance->student) }}" class="text-blue-600 hover:text-blue-800 underline">
                        {{ $attendance->student->name }}
                    </a>
                </p>
            </div>

            <!-- Student Number -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Student Number</label>
                <p class="mt-2 text-lg text-gray-900 dark:text-white">{{ $attendance->student->student_number }}</p>
            </div>

            <!-- Student Email -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Student Email</label>
                <p class="mt-2 text-lg text-gray-900 dark:text-white">{{ $attendance->student->email }}</p>
            </div>

            <!-- Attendance Date -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
                <p class="mt-2 text-lg font-semibold text-gray-900 dark:text-white">{{ $attendance->date->format('l, F d, Y') }}</p>
            </div>

            <!-- Attendance Status -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                <p class="mt-2">
                    @if($attendance->status === 'present')
                        <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-lg font-semibold">✓ Present</span>
                    @elseif($attendance->status === 'absent')
                        <span class="px-4 py-2 bg-red-100 text-red-800 rounded-full text-lg font-semibold">✗ Absent</span>
                    @else
                        <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-lg font-semibold">⏱ Late</span>
                    @endif
                </p>
            </div>

            <!-- Record Created Date -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Record Created</label>
                <p class="mt-2 text-lg text-gray-900 dark:text-white">{{ $attendance->created_at->format('M d, Y H:i A') }}</p>
            </div>

            <!-- Record Updated Date -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Updated</label>
                <p class="mt-2 text-lg text-gray-900 dark:text-white">{{ $attendance->updated_at->format('M d, Y H:i A') }}</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4 mt-8">
                <a href="{{ route('attendance.edit', $attendance) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                    Edit Record
                </a>
                <a href="{{ route('attendance.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                    Back to List
                </a>
                <form action="{{ route('attendance.destroy', $attendance) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-6 rounded" onclick="return confirm('Are you sure?')">
                        Delete Record
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

