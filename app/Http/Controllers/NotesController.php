<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
            $notes = Note::paginate(10);

            $user_notes = Note::where('owner', Auth::user()->id)->get();

            return view('notes.index', [
                'notes' => $notes,
                'user_notes' => $user_notes
            ]);
        }
        else return redirect()->route('notes.error');
    }

    public function error()
    {
        return view('notes.error');
    }

    public function note($id)
    {
        $note = Note::findOrFail($id);
        
        if(Auth::check() && Auth::user()->id == $note->owner) return view('notes.note', [
            'note' => $note
        ]);
        else return redirect()->route('notes.index');
    }

    public function delete($id)
    {
        $note = Note::findOrFail($id);
        if(Auth::check() && Auth::user()->id == $note->owner)
        {
            $note->delete();

            return redirect()->route('notes.index');
        }
        else return redirect()->route('notes.index');
    }

    public function edit($id)
    {
        $note = Note::findOrFail($id);
        if(Auth::check() && Auth::user()->id == $note->owner )return view('notes.form', [
            'note' => $note
        ]);
        else return redirect()->route('notes.index');
    }

    public function add()
    {
        return view('notes.form');
    }

    public function create()
    {
        return view('notes.create');
    }

    public function save(Request $request)
    {
        if(Auth::check())
        {
            if ($request->has('id'))
            {
                $note = Note::findOrFail($request->input('id'));
            }
            else
            {
                $note = new Note();
            }
            $note->title = $request->input('title');
            $note->text = $request->input('text');
            $note->owner = Auth::user()->id;
            $note->save();
            
            return redirect()->route('notes.index');
        }
        else return redirect()->route('notes.index');
    }

    public function checkNotes()
    {
        $note = Note::where('owner', Auth::user()->id)->first();
        if(!$note)
        {
            echo "test";
        }
    }
}
