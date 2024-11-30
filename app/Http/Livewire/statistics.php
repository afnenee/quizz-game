<?php

namespace App\Http\Livewire;

use App\Models\Test;
use Livewire\Component;
use DB;
use App\Models\Category;

// class statistics extends Component
// {
//     public $totalParticipants;
//     public $averageScore;
//     public $topUsers;

//     public function mount()
//     {
//         // Count total participants
//         $this->totalParticipants = Test::whereHas('user')->count();

//         // Calculate the average score
//         $this->averageScore = Test::avg('result');

//         // Fetch the top 3 users based on the highest result scores
//         $this->topUsers = Test::whereHas('user')
//             ->with('user:id,name') // Only load necessary user fields
//             ->orderBy('result', 'desc')
//             ->take(3)
//             ->get(['user_id', 'result']);
//     }

//     public function render()
//     {
//         return view('livewire.statistics');
//     }
// }
class statistics extends Component
{
    // public $totalParticipants;
    // public $averageScore;
    // public $topUsers;
    // public $categoryStatistics;
    // public $categories;


    // public function mount()
    // {
    //     $this->totalParticipants = Test::whereHas('user')->count();
    //     $this->averageScore = Test::avg('result');

    //     $this->topUsers = Test::whereHas('user')
    //         ->with('user:id,name')
    //         ->orderBy('result', 'desc')
    //         ->take(3)
    //         ->get(['user_id', 'result']);

    //     // $this->categoryStatistics = Test::with('category')
    //     //     ->selectRaw('category_id, COUNT(*) as participants, AVG(result) as avg_score')
    //     //     ->groupBy('category_id')
    //     //     ->with('category:id,name')
    //     //     ->get();

    //     $this->categoryStatistics = Test::with('category')
    //         ->select('category_id', DB::raw('COUNT(*) as participants'), DB::raw('AVG(result) as avg_score'))
    //         ->groupBy('category_id')
    //         ->get()
    //         ->map(function ($stat) {
    //             $stat->category_name = $stat->category ? $stat->category->name : 'Unknown';
    //             return $stat;
    //         });

    //     $this->categories = Category::all();

    // }

    // public function render()
    // {
    //     return view('livewire.statistics',['categories' => $this->categories,'categoryStatistics' => $this->categoryStatistics]);
    // }
    public $totalParticipants;
    public $averageScore;
    public $topUsers;
    public $categoryStatistics;
    public $categories;

    public function mount()
    {
        $this->totalParticipants = Test::whereHas('user')->count();
        $this->averageScore = Test::avg('result');

        $this->topUsers = Test::whereHas('user')
            ->with('user:id,name')
            ->orderBy('result', 'desc')
            ->take(3)
            ->get(['user_id', 'result']);

            $this->categoryStatistics = Test::with('category')
            ->select('category_id', DB::raw('COUNT(*) as participants'), DB::raw('AVG(result) as avg_score'))
            ->groupBy('category_id')
            ->get()
            ->map(function ($stat) {
                $category = Category::find($stat->category_id);
                $stat->category_name = $category ? $category->name : 'Unknown';
                return $stat;
            });

        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.statistics', [
            'categories' => $this->categories,
            'categoryStatistics' => $this->categoryStatistics
        ]);
    }
}
