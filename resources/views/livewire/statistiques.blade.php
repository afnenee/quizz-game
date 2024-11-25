<div class="container mx-auto p-8 bg-gradient-to-r from-indigo-50 via-white to-indigo-50 rounded-lg shadow-lg">
    <!-- Statistics Section -->

    <!-- Top 3 Users Section -->
    <div class="top-users mt-10 bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-semibold text-center text-yellow-700 mb-6">🏆 Top 3 Participants</h2>

        <div class="podium flex justify-center items-end gap-4">
            <!-- Second Place -->
            <div class="second-place w-32 bg-yellow-200 rounded-lg shadow-md text-center p-4">
                <span class="text-xl font-bold text-yellow-700">2nd</span>
                <p class="text-lg font-medium text-yellow-800 mt-2">{{ $topUsers[1]->user->name ?? 'N/A' }}</p>
                <p class="text-sm font-bold text-yellow-900">{{ $topUsers[1]->result ?? '--' }}</p>
            </div>

            <!-- First Place (center focus) -->
            <div class="first-place w-36 bg-yellow-300 rounded-lg shadow-lg text-center p-6 transform scale-110">
                <span class="text-2xl font-bold text-yellow-800">1st</span>
                <p class="text-lg font-medium text-yellow-900 mt-2">{{ $topUsers[0]->user->name ?? 'N/A' }}</p>
                <p class="text-sm font-bold text-yellow-900">{{ $topUsers[0]->result ?? '--' }}</p>
            </div>

            <!-- Third Place -->
            <div class="third-place w-32 bg-yellow-200 rounded-lg shadow-md text-center p-4">
                <span class="text-xl font-bold text-yellow-700">3rd</span>
                <p class="text-lg font-medium text-yellow-800 mt-2">{{ $topUsers[2]->user->name ?? 'N/A' }}</p>
                <p class="text-sm font-bold text-yellow-900">{{ $topUsers[2]->result ?? '--' }}</p>
            </div>
        </div>
    </div>



    <div class="min-h-screen flex justify-center items-center">
        <div class="stats-grid grid grid-cols-1 gap-6">
            <div class="stat-item p-4 bg-gradient-to-r from-blue-100 to-blue-50 rounded-lg shadow-md text-center">
                <h2 class="text-2xl font-bold text-blue-700 mb-4">Statistics Overview</h2>
                <div class="flex justify-around items-center space-x-4">
                    <div>
                        <h2 class="text-lg font-semibold text-blue-700">Total Participants  .....</h2>
                        <p class="text-2xl font-bold text-blue-800 mt-2">{{ $totalParticipants }}</p>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-green-700">...........  Average Score</h2>
                        <p class="text-2xl font-bold text-green-800 mt-2">{{ number_format($averageScore, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>








</div>
