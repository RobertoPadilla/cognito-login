<?php

namespace App\Controllers;

use App\Models\Image;

class GalleryController extends BaseController
{
    public function index()
    {
        $image = new Image();
        $session = session();

        $images = $image->getByUser($session->get('user_id'));

        return view('gallery', compact('images'));
    }
}
