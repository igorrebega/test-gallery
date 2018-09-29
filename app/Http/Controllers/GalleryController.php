<?php

namespace App\Http\Controllers;

use App\Http\Requests\Gallery\CreateGalleryRequest;
use App\Models\Gallery;
use App\Models\Photo;

class GalleryController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @param Gallery $gallery
     * @param Photo   $photo
     * @return \Illuminate\Http\Response
     */
    public function index(Gallery $gallery, Photo $photo)
    {
        $galleries = $gallery->getGalleries();

        foreach ($galleries as $id => $gallery) {
            $galleries[$id]['cover'] = $photo->getCover($id);
        }

        return view('gallery/index', compact('galleries'));
    }

    /**
     * Create gallery
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $model = new Gallery();

        return view('gallery/create', ['model' => $model]);
    }

    /**
     * Store gallery
     *
     * @param CreateGalleryRequest $request
     * @param Gallery              $gallery
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateGalleryRequest $request, Gallery $gallery)
    {
        $gallery->addNewGallery($request->get('title'));

        \Toastr::success('Gallery was created');

        return redirect('/');
    }

    /**
     * Edit gallery
     *
     * @param         $id
     * @param Gallery $gallery
     * @param Photo   $photo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, Gallery $gallery, Photo $photo)
    {
        $model = $gallery->getGallery($id);

        $photos = $photo->getPhotos($id);

        return view('gallery/edit', ['id' => $id, 'model' => $model, 'photos' => $photos]);
    }

    /**
     * Update gallery
     *
     * @param                      $id
     * @param CreateGalleryRequest $request
     * @param Gallery              $gallery
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, CreateGalleryRequest $request, Gallery $gallery)
    {
        $gallery->updateGalleryTitle($id, $request->get('title'));

        \Toastr::success('Gallery was updated');

        return redirect('/');
    }

    /**
     * Remove gallery
     *
     * @param         $id
     * @param Gallery $gallery
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id, Gallery $gallery)
    {
        $gallery->remove($id);

        \Toastr::success('Gallery was deleted');

        return redirect('/');
    }
}
