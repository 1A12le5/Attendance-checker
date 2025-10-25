@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Student Details</h1>
    </div>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <!-- Student Name -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                <p class="mt-2 text-lg font-semibold text-gray-900 dark:text-white">{{ $student->name }}</p>
            </div>

            <!-- Student Email -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <p class="mt-2 text-lg text-gray-900 dark:text-white">{{ $student->email }}</p>
            </div>

            <!-- Student Number -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Student Number</label>
                <p class="mt-2 text-lg text-gray-900 dark:text-white">{{ $student->student_number }}</p>
            </div>

            <!-- Created Date -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Created Date</label>
                <p class="mt-2 text-lg text-gray-900 dark:text-white">{{ $student->created_at->format('M d, Y') }}</p>
            </div>

            <!-- Attendance Count -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Total Attendance Records</label>
                <p class="mt-2 text-lg text-gray-900 dark:text-white">{{ $student->attendances()->count() }}</p>
            </div>

            <!-- Recent Attendance -->
            @if($student->attendances()->count() > 0)
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-4">Recent Attendance</label>
                <table class="min-w-full border-collapse border border-gray-300 dark:border-gray-600">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Date</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($student->attendances()->latest()->take(5)->get() as $attendance)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $attendance->date->format('M d, Y') }}</td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                                @if($attendance->status === 'present')
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">✓ Present</span>
                                @elseif($attendance->status === 'absent')
                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-semibold">✗ Absent</span>
                                @else
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">⏱ Late</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex gap-4 mt-8">
                <a href="{{ route('students.edit', $student) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                    Edit Student
                </a>
                <a href="{{ route('students.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                    Back to List
                </a>
                <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-6 rounded" onclick="return confirm('Are you sure?')">
                        Delete Student
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

