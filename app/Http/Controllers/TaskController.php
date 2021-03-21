<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
  // Vista principal
  // Listado de tareas 
    public function index()
    {
        // Collecion de Tareas
        $tareas = Task::all();

        return view ('index')->with('tareas', $tareas);
    }

  
    public function create()
    {
       
      
    }

   
    public function store(Request $request)
    {
        $tarea = Task::create([
            'name' => $request->name ,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'modality' => $request->modality,
            'status' => 'Incompleto',

        ]);
        return redirect()->back();
    }

    
    public function show($id)
    {
        $tarea = Task::find($id);
        return view('show') -> with('tarea', $tarea);
    }

    public function edit($id)
    {
           $tarea = Task::find($id);

        
            if ($tarea->status =='Completa') {
                $tarea->status = 'Incompleto';
            
            }
            
            elseif ($tarea->status =='Incompleto') {
                $tarea->status = 'Completa';
            
            }
        
      
            
       
        
        $tarea->save();
        return redirect()->back();
    }

    
    public function update(Request $request, $id)
    {
        // Modo n00b
        /*
        $tarea =Task::find($id);

        $tarea->name = $request->name;
        $tarea->description = $request->description;
        $tarea->due_date = $request->due_date;

        $tarea->save();
        */

        $tarea =Task::find($id);
          $tarea->update([
            'name' => $request->name ,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'modality' => $request->modality,
            'status' => $tarea->status,


        ]);



        //Regresar al usuario a show
        return redirect()->route('tareas.index', $tarea->id);
    }



   
    public function destroy($id)
    {
        $tarea = Task::find($id);

        $tarea->delete();

        return redirect()->route('tareas.index');
    }


}
