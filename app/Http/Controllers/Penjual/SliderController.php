<?php

namespace App\Http\Controllers\Penjual;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderFormRequest;
use App\Models\Slider;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('penjual.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('penjual.sliders.create');
    }

    public function store(SliderFormRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;

            $file->move('uploads/slider/', $filename);
            $validatedData['image'] = 'uploads/slider/' . $filename;
        }

        $validatedData['status'] = $request->status == true ? '1' : '0';

        Slider::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'],
            'status' => $validatedData['status'],
        ]);

        return redirect('/penjual/sliders')->with('message', 'Slider added successfully');
    }

    public function edit(Slider $slider)
    {
        return view('penjual.sliders.edit', compact('slider'));
    }

    public function update(SliderFormRequest $request, Slider $slider)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $path = $slider->image;
            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('image');

            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;

            $file->move('uploads/slider/', $filename);
            $validatedData['image'] = 'uploads/slider/' . $filename;
        }

        $validatedData['status'] = $request->status == true ? '1' : '0';

        Slider::where('id', $slider->id)->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'] ?? $slider->image,
            'status' => $validatedData['status'],
        ]);

        return redirect('/penjual/sliders')->with('message', 'Slider updateds successfully');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->count() > 0) {
            $path = $slider->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $slider->delete();
            return redirect('/penjual/sliders')->with('message', 'Slider deleted successfully');
        }
        return redirect('/penjual/sliders')->with('message', 'Something went wrong');
    }
}
