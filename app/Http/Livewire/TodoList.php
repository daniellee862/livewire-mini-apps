<?php

namespace App\Http\Livewire;

use App\Models\TodoItem;
use Livewire\Component;

class TodoList extends Component
{
    public $todos;
    public $todoText = '';

    public function mount()
    {
        $this->selectTodos();
    }
    public function render()
    {
        return view('livewire.todo-list');
    }

    public function addTodo()
    {
        //new model instance
        $todo = new TodoItem();
        //entry to column
        $todo->todo = $this->todoText;
        //entry to column
        $todo->completed = false;
        //save to DB
        $todo->save();

        //reset text
        $this->todoText = '';
        //get updated list
        $this->selectTodos();
    }

    public function toggleTodo($id)
    {
        //get first item that matches id
        $todo = TodoItem::where('id', $id)->first();

        //if it doesn't exist return
        if(!$todo)
        {
            return;
        }

        //if exists set completed to opposite of current state
        $todo->completed = !$todo->completed;
        //save
        $todo->save();
        //get updated list
        $this->selectTodos();
    }

    public function deleteTodo($id)
    {
        //get item
        $todo = TodoItem::where('id', $id)->first();
        //if item doesn't exist, return
        if (!$todo)
        {
            return;
        }

        //delete item
        $todo->delete();
        //get updated list
        $this->selectTodos();
    }

    public function selectTodos()
    {
        $this->todos = TodoItem::orderBy('created-at', 'DESC')->get();
    }
}
