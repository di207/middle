<?php


class Image
{
    private $image;
    private $name;
    private $saveName;
    private $width;
    private $height;
    private $type;

    public function __construct($file)
    {
        $this->setType($file);
        $this->imageName($file);
        $this->openImage($file);
        $this->setSize();
    }

    private function setType($file)
    {
        $pic = getimagesize($file);
        switch( $pic['mime'] ) {
            case 'image/jpeg': $this->type = 'jpg'; break;
            case 'image/png': $this->type = 'png'; break;
            case 'image/gif': $this->type = 'gif'; break;
        }
    }

    private function imageName($file)
    {
        $this->name = substr($file, strrpos($file, '/')+1, strrpos($file, '.')-1 - strrpos($file, '/'));
        $this->saveName = time().'_'.$this->name;
    }

    private function openImage($file)
    {
        switch($this->type) {
            case 'jpg': $this->image = @imagecreatefromJpeg($file); break;
            case 'png': $this->image = @imagecreatefromPng($file); break;
            case 'gif': $this->image = @imagecreatefromGif($file); break;
        }
    }

    private function setSize()
    {
        $this->width = imageSX($this->image);
        $this->height = imageSY($this->image);
    }

    public function resize($max_width = false, $max_height = false)
    {
        if (is_numeric($max_width) && is_numeric($max_height) && $max_width > 0 && $max_height > 0) {
            $newSize = $this->getSizeByFramework($max_width, $max_height);
        }
        elseif (is_numeric($max_width) && $max_width > 0) {
            $newSize = $this->getSizeByWidth($max_width);
        }
        else {
            $newSize = array($this->width, $this->height);
        }
        $newImage = imagecreatetruecolor($newSize[0], $newSize[1]);
        if ($this->type == 'gif' || $this->type == 'png') {
            $white = imagecolorallocate($newImage, 255, 255, 255);
            imagefill($newImage, 0, 0, $white);
        }
        imagecopyresampled($newImage, $this->image, 0, 0, 0, 0, $newSize[0], $newSize[1], $this->width, $this->height);
        $this->image = $newImage;
        $this->setSize();
        return $this;
    }

    private function getSizeByFramework($width, $height)
    {
        if ($this->width <= $width && $this->height <= $height) {
            return array($this->width, $this->height);
        }
        if ($this->width/$width > $this->height/$height) {
            $newSize[0] = $width;
            $newSize[1] = round($this->height * $width / $this->width);
        }
        else {
            $newSize[0] = round($this->width * $height / $this->height);
            $newSize[1] = $height;
        }
        return $newSize;
    }

    private function getSizeByWidth($width)
    {
        if ($width >= $this->width) {
            return array($this->width, $this->height);
        }
        $newSize[0] = $width;
        $newSize[1] = round($this->height * $width / $this->width);
        return $newSize;
    }

    public function save($fileName = null, $path = __DIR__.'/images/', $type = false)
    {
        if (is_null($fileName)) $fileName = $this->saveName;
        if (trim($fileName) == '' || $this->image === false || ! is_dir($path)) return false;
        $type = strtolower($type);

        switch($type)
        {
            case false:
                $savePath = $path.trim($fileName).'.'.$this->type;
                switch($this->type)
                {
                    case 'jpg':
                        imagejpeg($this->image, $savePath);
                        return $savePath;
                    case 'png':
                        imagepng($this->image, $savePath);
                        return $savePath;
                    case 'gif':
                        imagegif($this->image, $savePath);
                        return $savePath;
                    default:
                        return false;
                }
                break;
            case 'jpg':
                $savePath = $path.trim($fileName).'.'.$type;
                imagejpeg($this->image, $savePath);
                return $savePath;
            case 'png':
                $savePath = $path.trim($fileName).'.'.$type;
                imagepng($this->image, $savePath);
                return $savePath;
            case 'gif':
                $savePath = $path.trim($fileName).".".$type;
                imagegif($this->image, $savePath);
                return $savePath;
            default:
                return false;
        }
        imagedestroy($this->image);
    }
}