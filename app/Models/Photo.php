<?php

namespace App\Models;

class Photo extends BaseJsonModel
{
    /**
     * Add new gallery
     *
     * @param $id
     * @param $name
     */
    public function addPhotoToGallery($id, $name)
    {
        $data = $this->getData();

        if (! isset($data['galleries'][$id]['photos'])) {
            $data['galleries'][$id]['photos'] = [];
        }

        $data['galleries'][$id]['photos'][] = ['name' => $name, 'isPrimary' => false];

        $this->setData($data);
    }

    /**
     * Photos list
     *
     * @param $galleryId
     * @return array
     */
    public function getPhotos($galleryId)
    {
        $this->checkIfGalleryExist($galleryId);
        $data = $this->getData();

        if (! isset($data['galleries'][$galleryId]['photos'])) {
            return [];
        }

        //Select cover
        $photos = $data['galleries'][$galleryId]['photos'];

        $hasCover = false;
        foreach ($photos as $key => $photo) {
            if ($photo['isPrimary']) {
                $hasCover = true;
            }
        }

        if (! $hasCover && count($photos)) {
            $photos[0]['isPrimary'] = true;
        }

        return $photos;
    }

    /**
     * @param $galleryId
     * @return bool
     */
    public function getCover($galleryId)
    {
        $this->checkIfGalleryExist($galleryId);
        $data = $this->getData();

        //Select cover
        $photos = $data['galleries'][$galleryId]['photos'];

        foreach ($photos as $key => $photo) {
            if ($photo['isPrimary']) {
                return $photo['name'];
            }
        }

        if (count($photos)) {
            return $photos[0]['name'];
        }

        return false;
    }


    /**
     * Remove photo
     *
     * @param $galleryId
     * @param $id
     */
    public function remove($galleryId, $id)
    {
        $this->checkIfGalleryExist($galleryId);

        $data = $this->getData();

        if (! isset($data['galleries'][$galleryId]['photos'][$id])) {
            abort(404);
        }

        $name = $data['galleries'][$galleryId]['photos'][$id]['name'];

        \Storage::disk('images')->delete($galleryId . '/' . $name);

        unset($data['galleries'][$galleryId]['photos'][$id]);

        $this->setData($data);
    }

    /**
     * Make cover
     *
     * @param $galleryId
     * @param $id
     */
    public function makeCover($galleryId, $id)
    {
        $this->checkIfGalleryExist($galleryId);
        $data = $this->getData();

        if (! isset($data['galleries'][$galleryId]['photos'][$id])) {
            abort(404);
        }

        $photos = $data['galleries'][$galleryId]['photos'];
        foreach ($photos as $key => $photo) {
            $photos[$key]['isPrimary'] = false;
        }

        $photos[$id]['isPrimary'] = true;
        $data['galleries'][$galleryId]['photos'] = $photos;

        $this->setData($data);
    }
}