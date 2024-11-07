<?php

// namespace App\Http\Livewire\Question;

// use App\Models\Question;
// use Illuminate\Contracts\View\View;
// use Livewire\Component;

// class QuestionForm extends Component
// {
//     public Question $question;

//     public array $options = [];

//     public bool $editing = false;

//     protected $rules = [
//         'question.text' => 'required|string',
//        // 'question.code_snippet' => 'nullable|string',
//        // 'question.answer_explanation' => 'nullable|string',
//        // 'question.more_info_link' => 'nullable|url',
//         'options' => 'required|array',
//         'options.*.text' => 'required|string',
//     ];

//     public function mount(Question $question): Void
//     {
//         $this->question = $question;

//         if ($this->question->exists) {
//             $this->editing = true;

//             foreach ($this->question->options as $option) {
//                 $this->options[] = [
//                     'id' => $option->id,
//                     'text' => $option->text,
//                     'correct' => $option->correct,
//                 ];
//             }
//         }
//     }

//     public function addOption(): Void
//     {
//         $this->options[] = [
//             'text' => '',
//             'correct' => false
//         ];
//     }

//     public function removeOption(int $index): Void
//     {
//         unset($this->options[$index]);
//         $this->options = array_values(($this->options));
//     }

//     public function save()
//     {
//         $this->validate();

//         $this->question->save();

//         $this->question->options()->delete();

//         foreach ($this->options as $option) {
//             $this->question->options()->create($option);
//         }

//         return to_route('questions');
//     }

//     public function render(): View
//     {
//         return view('livewire.question.question-form');
//     }
// }

namespace App\Http\Livewire\Question;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class QuestionForm extends Component
{
    public Question $question;
    public array $options = [];
    public bool $editing = false;

    public $categories;            // Holds list of categories
    public $selectedCategory;      // ID of the selected category
    public $newCategoryName = '';  // New category name if the user wants to create one

    protected $rules = [
        'question.text' => 'required|string',
        'selectedCategory' => 'nullable|exists:categories,id', // Validation for selected category
        'options' => 'required|array',
        'options.*.text' => 'required|string',
    ];

    public function mount(Question $question): void
    {
        $this->question = $question;
        $this->categories = Category::all();  // Load categories for dropdown
        $this->selectedCategory = $question->category_id;  // Set selected category if editing

        if ($this->question->exists) {
            $this->editing = true;

            foreach ($this->question->options as $option) {
                $this->options[] = [
                    'id' => $option->id,
                    'text' => $option->text,
                    'correct' => $option->correct,
                ];
            }
        }
    }

    public function addOption(): void
    {
        $this->options[] = [
            'text' => '',
            'correct' => false
        ];
    }

    public function removeOption(int $index): void
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    public function save()
    {
        $this->validate();

        // Handle new category creation
        if ($this->newCategoryName) {
            $category = Category::create(['name' => $this->newCategoryName]);
            $this->selectedCategory = $category->id;
        }

        $this->question->category_id = $this->selectedCategory; // Associate selected category
        $this->question->save();

        // Sync options
        $this->question->options()->delete();
        foreach ($this->options as $option) {
            $this->question->options()->create($option);
        }

        return to_route('questions');
    }

    public function render(): View
    {
        return view('livewire.question.question-form');
    }
}
