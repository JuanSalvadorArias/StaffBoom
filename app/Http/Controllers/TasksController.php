<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statement = "SELECT * FROM tasks;";
        $data = DB::select($statement);
        return Inertia::render('Tasks/index', ['tasks' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        $statement = "INSERT INTO tasks (titulo, descripcion, fecha_vencimiento,user_id,created_at)
                                    VALUES (?,?,?,?,?)";
        $parameters = [
            $request->titulo,
            $request->descripcion,
            date('Y-m-d H:i:s', strtotime($request->fecha_vencimiento)),
            $userId,
            now()
        ];
        DB::select($statement, $parameters);
        return redirect()->route('task.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function show(Tasks $tasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function edit(Tasks $tasks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return $request['id'];
        $statement = "UPDATE tasks SET titulo = ?, descripcion = ?, fecha_vencimiento = ? WHERE id = ?";
        $parameters = [
            $request->titulo,
            $request->descripcion,
            $request->fecha_vencimiento,
            $request->id
        ];
        DB::statement($statement, $parameters);
        return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $statement = "DELETE FROM tasks WHERE id = ?";
        $parameters = [$id];
        DB::select($statement, $parameters);
        return redirect()->route('task.index');
    }
}
