<?php

namespace App\Livewire\Backend\Category;

use Livewire\Component;
use App\Models\Category;
class Index extends Component
{
    public $categoryIdToDelete;

    public function render()
    {
        $categories = Category::all(); // Fetch all categories
        return view('livewire.backend.category.index', [
            'categories' => $categories,
        ]);
    }

    public function confirmDelete($categoryId)
    {
        $this->categoryIdToDelete = $categoryId;
    }

    public function deleteCategory()
    {
        $category = Category::find($this->categoryIdToDelete);
        if ($category) {
            if ($category->image) {
                unlink('storage/' . $category->image);
            }
            $category->delete();
            session()->flash('message', 'Category deleted successfully.');
        } else {
            session()->flash('error', 'Category not found.');
        }
        $this->categoryIdToDelete = null; // Reset after deletion
        $this->dispatch('closeModal'); // Close the modal
    }
}