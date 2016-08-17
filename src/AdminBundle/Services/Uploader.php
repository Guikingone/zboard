<?php

/*
 * This file is part of the Zboard project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AdminBundle\Services;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class Uploader
{
    private $fileDir;

    /**
     * Upaloder constructor.
     *
     * @param $fileDir  | The directory where the file is uploaded.
     */
    public function __construct($fileDir)
    {
        $this->fileDir = $fileDir;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->fileDir, $fileName);

        return $fileName;
    }
}
