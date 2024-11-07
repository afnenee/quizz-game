<?php
namespace App\Http\Livewire\Quiz;

use App\Models\Category;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Illuminate\Support\Str;

class QuizForm extends Component
{
    public Quiz $quiz;
    public array $questions = []; // Bind the selected questions
    public array $questionsSelected = [];
    public bool $editing = false;
    public array $listsForFields = [];
    public $category_id = null;
    public $categories;

    protected $rules = [
        'quiz.title' => 'required|string',
        'quiz.slug' => 'string',
        'quiz.description' => 'nullable|string',
        'quiz.published' => 'boolean',
        'quiz.public' => 'boolean',
        'questions' => 'nullable|array',
    ];

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
        $this->categories = Category::all();
        $this->initListsForFields();

        if ($this->quiz->exists) {
            $this->editing = true;
            $this->questions = $this->quiz->questions()->pluck('id')->toArray();
            $this->category_id = $this->quiz->category_id ?? null;
        } else {
            $this->quiz->published = true;
            $this->quiz->public = false;
        }
    }
    public function updatedQuestions($value)
    {
        $this->questions = array_filter($this->questions, function ($id) use ($value) {
            return $id !== $value;
        });
    }

    public function updatedCategoryId()
    {
        $this->loadQuestions($this->category_id);
    }

    public function loadQuestions($categoryId)
    {
        if ($categoryId) {
            $this->questions = Question::where('category_id', $categoryId)->pluck('text', 'id')->toArray();
        } else {
            $this->questions = [];
        }
    }

    public function updatedQuizTitle(): void
    {
        $this->quiz->slug = Str::slug($this->quiz->title);
    }

    public function save()
    {
        $this->validate();

        // Sync the selected question IDs to the questions property
        $this->questions = $this->questionsSelected;

        // Validate that the questions exist
        $validQuestionIds = array_filter($this->questions, function ($id) {
            return Question::where('id', $id)->exists();
        });

        $this->quiz->save();
        $this->quiz->questions()->sync($validQuestionIds);

        return to_route('quizzes');
    }



    protected function initListsForFields()
    {
        if ($this->category_id) {
            $this->questions = Question::where('category_id', $this->category_id)->pluck('text', 'id')->toArray();
        } else {
            $this->questions = Question::pluck('text', 'id')->toArray();
        }
    }

    public function render(): View
{
    $availableQuestions = collect($this->questions)->filter(function ($text, $id) {
        return !in_array($id, $this->quiz->questions->pluck('id')->toArray());
    });

    return view('livewire.quiz.quiz-form', [
        'categories' => $this->categories,
        'availableQuestions' => $availableQuestions,
    ]);
}


}
