<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Faq;
class Faqs extends Component
{
    public $propertyName;
    public $question;
    public $question_ar;
    public $answer;
    public $answer_ar;
    protected $rules=[
        'question'       => 'required|min:3|max:254',
        'question_ar'    => 'required|min:3|max:254',
        'answer'         => 'required|min:3|max:1000',
        'answer_ar'      => 'required|min:3|max:1000',
    ];
    protected $validationAttributes = [
        'email' => 'email address'
    ];
    public function render()
    {
        return view('livewire.faqs');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }
    public function store(Request $request)
    {
       $data=$this->validate();
       $faq=Faq::create($data);
       session()->flash('created',__("Changes has been Created Successfully"));
       return redirect()->route("faqs.index");

    }
    public function dehydrate() {
        $this->emit('initializeCkEditor');
   }

}
