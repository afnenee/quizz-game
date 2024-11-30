<x-app-layout>
    <div class="py-12 bg-gray-100" style="background-color: rgba(97, 117, 206, 0.66);">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-2xl font-extrabold text-gray-800 mb-6">Public Quizzes</h2>

                    <div class="flex flex-wrap gap-6">
                        @forelse($public_quizzes as $quiz)
                            <div class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 bg-white border border-gray-200 rounded-lg shadow-lg">
                                <div class="p-4">
                                    <a
                                        href="{{ route('quiz.show', $quiz->slug) }}"
                                        class="block text-lg font-bold text-blue-600 hover:text-blue-800">
                                        {{ $quiz->title }}
                                    </a>
                                    <p class="mt-2 text-sm text-gray-600">Questions: <span class="font-medium">{{ $quiz->questions_count }}</span></p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-gray-600 col-span-full">No public quizzes found.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12 bg-gray-50" style="background-color: rgba(97, 117, 206, 0.66);">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-2xl font-extrabold text-gray-800 mb-6">Quizzes for Registered Users</h2>

                    <div class="flex flex-wrap gap-6">
                        @forelse($registered_only_quizzes as $quiz)
                            <div class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 bg-white border border-gray-200 rounded-lg shadow-lg">
                                <div class="p-4">
                                    <a
                                        href="{{ route('quiz.show', $quiz->slug) }}"
                                        class="block text-lg font-bold text-blue-600 hover:text-blue-800">
                                        {{ $quiz->title }}
                                    </a>
                                    <p class="mt-2 text-sm text-gray-600">Questions: <span class="font-medium">{{ $quiz->questions_count }}</span></p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-gray-600 col-span-full">Register to see more quizzes...</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
