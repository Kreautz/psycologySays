<?php
  
namespace App\Http\Controllers;
  
use App\Forum;
use Illuminate\Http\Request;
  
class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forum = Forum::latest()->paginate(5);
  
        return view('forum.index',compact('forum'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forum.create');
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
        ]);
  
        Forum::create($request->all());
   
        return redirect()->route('forum.index')
                        ->with('success','A forum created successfully.');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function show(Forum $forum)
    {
        return view('forum.show',compact('forum'));
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function edit(Forum $forum)
    {
        return view('forum.edit',compact('forum'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Forum $forum)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
        ]);
  
        $forum->update($request->all());
  
        return redirect()->route('forum.index')
                        ->with('success','Forum updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Forum $forum)
    {
        $forum->delete();
  
        return redirect()->route('forum.index')
                        ->with('success','Forum deleted successfully');
    }
}