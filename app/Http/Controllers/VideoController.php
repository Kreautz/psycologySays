<?php
  
namespace App\Http\Controllers;
  
use App\Video;
use Illuminate\Http\Request;
  
class VideoController extends Controller
{
    public function index()
    {
        $video = Video::latest()->paginate(5);
  
        return view('video.index',compact('video'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('video.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
        ]);
  
        Video::create($request->all());
   
        return redirect()->route('video.index')
                        ->with('success','A Video created successfully.');
    }

    public function show(Video $video)
    {
        return view('video.show',compact('video'));
    }

    public function edit(Video $video)
    {
        return view('video.edit',compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
        ]);
  
        $video->update($request->all());
  
        return redirect()->route('video.index')
                        ->with('success','Video updated successfully');
    }

    public function destroy(Video $video)
    {
        $video->delete();
  
        return redirect()->route('video.index')
                        ->with('success','Video deleted successfully');
    }
}