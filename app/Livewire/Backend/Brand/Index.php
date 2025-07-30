<?php

namespace App\Livewire\Backend\Brand;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
class Index extends Component
{
    public $name, $status, $brandIdToUpdate;
    protected $listeners = ['resetForm' => 'resetInputs'];

    public function rules(){
        return [
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ];
    }

    public function resetInputs()
    {
        $this->name = '';
        $this->status = true; // Default to active
    }
    public function storeBrand()
    {
        $this->validate();
        Brand::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'status' => $this->status ? true : false,
        ]);
        session()->flash('message', 'Brand created successfully.');
        $this->resetInputs(); // Reset inputs after successful creation
        $this->dispatch('closeModal'); // Close the modal
        // Logic to store a new brand
        // This method will be called when the form is submitted
    }
    public function render()
    {
        $brands = Brand::all(); // Fetch all brands
        return view('livewire.backend.brand.index',['brands' => $brands])->extends('backend.layouts.master')->section('content');
    }

    public function editBrand($brand)
    {
        $this->brandIdToUpdate = $brand['id'];
        $this->name = $brand['name'];
        $this->status = $brand['status'];
        $this->dispatch('openEditModal', ['brand' => $brand]); // Open the edit modal with the brand data
        
    }

    public function updateBrand()
    {

        $this->validate();
        $brand = Brand::find($this->brandIdToUpdate);
   
        if ($brand) {
            $brand->update([
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'status' => $this->status ? true : false,
            ]);
            session()->flash('message', 'Brand updated successfully.');
            $this->resetInputs(); // Reset inputs after successful update
            $this->dispatch('closeModal'); // Close the modal
        } else {
            session()->flash('error', 'Brand not found.');
        }
    }


    public function confirmDelete($categoryId)
    {
        $this->brandIdToUpdate = $categoryId;
    }

    public function deleteBrand()
    {
        $brand = Brand::find($this->brandIdToUpdate);
        if ($brand) {

            $brand->delete();
            session()->flash('message', 'Brand deleted successfully.');
        } else {
            session()->flash('error', 'Brand not found.');
        }
        $this->brandIdToUpdate = null; // Reset after deletion
        $this->dispatch('closeModal'); // Close the modal
    }
}
