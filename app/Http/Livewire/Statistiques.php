<?php

namespace App\Http\Livewire;

use App\Models\Test;
use Livewire\Component;

class Statistiques extends Component
{
    public $totalParticipants;
    public $averageScore;
    public $topUsers;

    public function mount()
    {
        // Count total participants
        $this->totalParticipants = Test::whereHas('user')->count();

        // Calculate the average score
        $this->averageScore = Test::avg('result');

        // Fetch the top 3 users based on the highest result scores
        $this->topUsers = Test::whereHas('user')
            ->with('user:id,name') // Only load necessary user fields
            ->orderBy('result', 'desc')
            ->take(3)
            ->get(['user_id', 'result']);
    }

    public function render()
    {
        return view('livewire.statistiques');
    }
}
