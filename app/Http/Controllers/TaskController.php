<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function addNewTask(Request $request) {
        try {
            $fields = $request->validate([
                'title' => ['required'],
                'description' => ['required'],
                'deadline' => ['required', 'date'],
            ]);
            
            $taskOwner = Auth::user();

            $taskData = [
                'taskOwner' => $taskOwner->id,
                'title' => $fields['title'],
                'description' => $fields['description'],
                'status' => 'Pending',
                'deadlineDate' => $fields['deadline'],
                'dateCompleted' => null,
                'priority' => false,
            ];

            Task::create($taskData);

            return redirect()->route('all-tasks');
        } catch (\Throwable $th) {
            Log::error("Error in creating new tasks", ["error" => $th->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'Failed to create task.'])->withInput();
        }
    }
}
