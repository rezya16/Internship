<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\TaskRepository;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    /**
     * Экземпляр TaskRepository
     *
     * @var TaskRepository
     */
    protected $tasks;


    /**
     * TaskController constructor.
     *
     * @param TaskRepository $tasks
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }

    /**
     * Показать список всех задачь пользователя.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request) {

        return view('tasks.index', [
            'tasks' => $this->tasks->forUser($request->user()),
        ]);
    }

    /**
     * Создание новой задачи.
     *
     * @param Request $request
     * @return
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks');
    }

    public function destroy(Request $request, Task $task) {

        $this->authorize('destroy', $task);

        $task->delete();

        return redirect('/tasks');
    }

}
