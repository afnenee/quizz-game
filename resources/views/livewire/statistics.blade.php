
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>

<div class="container mx-auto p-8 bg-gradient-to-r from-indigo-50 via-white to-indigo-50 rounded-lg shadow-lg">

    <div class="top-users mt-5 bg-light rounded-lg shadow p-4">
        <h2 class="text-center mb-4">🏆 Top 3 Participants 🏆 </h2>
        <div class="podium d-flex justify-content-center align-items-end gap-3 position-relative">
            @foreach($topUsers as $index => $user)
                <div class="place card text-center shadow-sm p-3 border-0
                    {{ $index == 0 ? 'bg-warning bg-gradient text-dark first-place' : 'bg-secondary bg-gradient text-dark' }}
                    {{ $index == 1 ? 'second-place' : ($index == 2 ? 'third-place' : '') }}"
                    style="width: 8rem; transition: transform 0.3s, box-shadow 0.3s;"
                    onmouseover="this.style.transform='scale(1.1)'; this.style.boxShadow='0px 8px 16px rgba(0, 0, 0, 0.2)';"
                    onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0px 4px 8px rgba(0, 0, 0, 0.1)';">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">{{ $index + 1 }}{{ ['st', 'nd', 'rd'][$index] ?? 'th' }}</h5>
                        <p class="card-text">{{ $user->user->name ?? 'N/A' }}</p>
                        <p class="text-muted font-weight-bold">{{ $user->result ?? '--' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>




    <div class="stats-grid grid grid-cols-1 gap-6 mt-8">
        <div class="stat-item p-4 bg-gradient-to-r from-blue-100 to-blue-50 rounded-lg shadow-md text-center">
            <h2 class="text-2xl font-bold text-blue-700 mb-4">📊 Statistics Overview</h2>
            <div class="flex justify-around items-center space-x-4" style="text-align: center;">
                <div style="margin-left: 375px;">
                    <h2 class="text-lg font-semibold text-blue-700">Total Participants ....... </h2>
                    <p class="text-2xl font-bold text-blue-800 mt-2">{{ $totalParticipants }}</p>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-green-700">...  Average Score</h2>
                    <p class="text-2xl font-bold text-green-800 mt-2">{{ number_format($averageScore, 2) }}</p>
                </div>
            </div>
        </div>
    </div>


    <div class="category-stats mt-10 bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-semibold text-center text-purple-700 mb-6">📊 Statistics by Category</h2>
        <div class="flex flex-wrap gap-6 justify-center">
            @foreach($categoryStatistics as $categoryStat)
            @foreach ($categories as $category)
                <div class="category-item flex-grow-0 flex-shrink-0 basis-full md:basis-1/2 lg:basis-1/3 p-4 bg-purple-200 rounded-lg shadow-md text-center">
                    <h3 class="text-lg font-bold text-purple-800">{{ $category->name ?? 'Unknown' }}</h3>
                    <p class="text-sm text-purple-900 mt-2">Participants: <span class="font-bold">{{ $categoryStat->participants }}</span></p>
                    <p class="text-sm text-purple-900 mt-2">Average Score: <span class="font-bold">{{ number_format($categoryStat->avg_score, 2) }}</span></p>
                </div>
            @endforeach
            @endforeach
        </div>
    </div>


</div>
