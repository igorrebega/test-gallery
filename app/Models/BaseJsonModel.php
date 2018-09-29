<?php

namespace App\Models;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use League\Flysystem\FileExistsException;

abstract class BaseJsonModel
{
    /**
     * Write data to database
     *
     * @param array $data
     */
    protected function setData($data)
    {
        \Storage::disk('db')->put('db.json', json_encode($data));
    }

    /**
     * Return data from database
     *
     * @return array
     */
    protected function getData()
    {
        try {
            $data = \Storage::disk('db')->get('db.json');
        } catch (FileNotFoundException  $exception) {
            $data = ['galleries' => []];

            $this->setData($data);

            return $data;
        }

        return json_decode($data, true);
    }

    /**
     * Check if gallery exists
     * @param $id
     */
    public function checkIfGalleryExist($id)
    {
        $data = $this->getData();

        if (! isset($data['galleries'][$id])) {
            abort(404);
        }
    }
}
