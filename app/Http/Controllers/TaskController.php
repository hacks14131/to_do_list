<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TaskController extends Controller                                                                                                                                             
{
    public function update(Request $request, Task $task) {
        try {
            $request->validate([
                'title' => 'required|string',
                'description' => 'required|string',
                'deadline' => 'required|date',
            ]);

            $task->update([
                'title' => $request->title,
                'description' => $request->description,
                'deadlineDate' => $request->deadline,
            ]);

            return redirect()->back()->with('success', 'Task updated successfully.');
        } catch (\Throwable $th) {
            Log::error("Error deleting tasks", ["error" => $th->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'Failed to update task.'])->withInput();
        }
    }
    public function removeTask(Task $task) {
        try {
            $task->delete();

            return redirect()->back()->with('success', 'Task deleted successfully.');
        } catch (\Throwable $th) {
            Log::error("Error deleting tasks", ["error" => $th->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'Failed to delete task.'])->withInput();
        }
    }
    public function reopenTask(Task $task) {
        try {
            $task->status = 'Pending';
            $task->dateCompleted = null;
            $task->save();

            return redirect()->back()->with('success', 'Task has been reopened successfully.');
        } catch (\Throwable $th) {
            Log::error("Error in reopening task", ["error" => $th->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'Failed to reopen task.'])->withInput();
        }
    }
    public function markAsDone(Task $task) {
        try {
            $task->status = 'Completed';
            $task->dateCompleted = today();
            $task->save();

            return redirect()->back()->with('success', 'Task marked as done successfully.');
        } catch (\Throwable $th) {
            Log::error("Error in creating new tasks", ["error" => $th->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'Failed to update task.'])->withInput();
        }
    }
    public function prioritizeTask(Task $task) {
        try {
            $task->priority = true;
            $task->save();

            return redirect()->back()->with('success', 'Task prioritized successfully.');
        } catch (\Throwable $th) {
            Log::error("Error in prioritizing new tasks", ["error" => $th->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'Failed to update task.'])->withInput();
        }
    }
    public function index(Request $request) {
        $userID = Auth::user()->id;
        $tasks = Task::where("taskOwner", $userID)->where("status", "!=", "completed")->orderBy('created_at', 'desc')->get();
        return Inertia::render('Home', [
            'tasks' => $tasks
        ]);
    }
    public function renderPrioTask(Request $request) {
        try {
            $tasks = Task::priority()
                ->where("taskOwner", Auth::id())
                ->where("status", "!=", "completed")
                ->orderBy('updated_at', 'desc')
                ->get();
            return Inertia::render('Priority', [
                'tasks' => $tasks
            ]);
        } catch (\Throwable $th) {
            Log::error("An error occured while opening priority task", ["error" => $th->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'An error occured while opening priority task.'])->withInput();
        }
    }
    public function renderCompletedTask(Request $request) {
        try {
            $tasks = Task::where('status', 'Completed')
             ->orderBy('updated_at', 'desc')
             ->get();

            return Inertia::render('Completed', [
                'tasks' => $tasks
            ]);
        } catch (\Throwable $th) {
            Log::error("An error occured while opening completed task", ["error" => $th->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'An error occured while opening completed task.'])->withInput();
        }
    }
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
