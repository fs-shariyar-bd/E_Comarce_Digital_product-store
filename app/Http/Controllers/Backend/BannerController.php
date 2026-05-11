<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\BannerServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    protected $bannerService;

    public function __construct(BannerServiceInterface $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    public function index()
    {
        $banners = $this->bannerService->getAllPaginated(10);

        return view('backend.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('backend.banner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'link' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'position' => 'required|integer|min:1|unique:banners,position,NULL,id,type,' . $request->type,
            'type' => 'required|in:slider,side',
            'status' => 'required|in:0,1',
        ], [
            'position.unique' => 'This position number is already used for this banner type. Please use a different position.',
        ]);

        $data = $request->only(['link', 'position', 'type', 'status']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('frontend/images/banner/'), $imageName);
            $data['image'] = 'frontend/images/banner/' . $imageName;
        }

        $this->bannerService->create($data);

        return redirect()->route('banner.index')->with('success', 'Banner created successfully!');
    }

    public function edit($id)
    {
        $banner = $this->bannerService->find($id);
        return view('backend.banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'link' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'position' => 'required|integer|min:1',
            'type' => 'required|in:slider,side',
            'status' => 'required|in:0,1',
        ]);

        $data = $request->only(['link', 'position', 'type', 'status']);

        if ($request->hasFile('image')) {
            $banner = $this->bannerService->find($id);
            if ($banner->image && File::exists(public_path($banner->image))) {
                File::delete(public_path($banner->image));
            }
            $image = $request->file('image');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('frontend/images/banner/'), $imageName);
            $data['image'] = 'frontend/images/banner/' . $imageName;
        }

        $this->bannerService->update($id, $data);

        return redirect()->route('banner.index')->with('success', 'Banner updated successfully!');
    }

    public function delete($id)
    {
        $banner = $this->bannerService->find($id);

        if ($banner->image && File::exists(public_path($banner->image))) {
            File::delete(public_path($banner->image));
        }

        $this->bannerService->delete($id);

        return redirect()->route('banner.index')->with('success', 'Banner deleted successfully!');
    }
}