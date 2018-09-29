<?php

namespace App\Http\Controllers;

use App\Http\Requests\Gallery\CreateGalleryRequest;
use App\Http\Requests\Photo\PhotoRequest;
use App\Models\Gallery;
use App\Models\Photo;

class PhotoController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @param PhotoRequest $request
     * @param Gallery      $gallery
     * @param Photo        $photo
     * @return \Illuminate\Http\Response
     */
    public function upload(PhotoRequest $request, Gallery $gallery, Photo $photo)
    {
        $id = request('id');
        $gallery->checkIfExist($id);

        if (! $request->hasFile('filename')) {
            \Toastr::error('Please select at least 1 photo');

            return redirect()->back();
        }

        foreach ($request->file('filename') as $image) {
            $name = time() . '-' . str_random(3) . '.' . $image->getClientOriginalExtension();

            $image->move(public_path() . '/images/' . $id, $name);

            $photo->addPhotoToGallery($id, $name);
        }

        return redirect()->route('gallery.edit', ['id' => $id]);
    }

    /**
     * Remove gallery
     *
     * @param       $galleryId
     * @param       $id
     * @param Photo $photo
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($galleryId, $id, Photo $photo)
    {
        $photo->remove($galleryId, $id);

        \Toastr::success('Photo was deleted');

        return redirect()->route('gallery.edit', ['id' => $galleryId]);
    }

    /**
     * Make cover
     *
     * @param       $galleryId
     * @param       $id
     * @param Photo $photo
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function makeCover($galleryId, $id, Photo $photo)
    {
        $photo->makeCover($galleryId, $id);

        \Toastr::success('Cover was changed');

        return redirect()->route('gallery.edit', ['id' => $galleryId]);
    }
}
