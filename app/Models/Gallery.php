<?php

namespace App\Models;

class Gallery extends BaseJsonModel
{
    /**
     * Add new gallery
     *
     * @param $title
     */
    public function addNewGallery($title)
    {
        $data = $this->getData();
        $data['galleries'][] = [
            'title'  => $title,
            'photos' => []
        ];

        $this->setData($data);
    }

    /**
     * Update gallery title
     *
     * @param $id
     * @param $title
     */
    public function updateGalleryTitle($id, $title)
    {
        $data = $this->getData();

        if (! isset($data['galleries'][$id])) {
            abort(404);
        }

        $data['galleries'][$id]['title'] = $title;

        $this->setData($data);
    }


    /**
     * Add new gallery
     *
     * @param $id
     */
    public function remove($id)
    {
        $data = $this->getData();

        if (isset($data['galleries'][$id])) {
            unset($data['galleries'][$id]);
        }
        \Storage::disk('images')->deleteDirectory($id);

        $this->setData($data);
    }

    /**
     * Get gallery by id
     *
     * @param $id
     * @return mixed
     */
    public function getGallery($id)
    {
        $data = $this->getData();

        if (! isset($data['galleries'][$id])) {
            abort(404);
        }

        return $data['galleries'][$id];
    }

    /**
     * Return array with galleries
     *
     * @return array
     */
    public function getGalleries()
    {
        $data = $this->getData();

        return $data['galleries'];
    }

    /**
     * Check if gallery exists
     * @param $id
     */
    public function checkIfExist($id)
    {
        $data = $this->getGalleries();
        if (! isset($data[$id])) {
            abort(404);
        }
    }
}