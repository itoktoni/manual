<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Image extends Component
{
    public $src;

    public $alt;

    public $class;

    public $width;

    public $height;

    public $loading;

    public $responsive;

    public $rounded;

    public $thumbnail;

    public $id;

    public $style;

    public $attributes;

    public $popup;

    public $popupTitle;

    public $popupWidth;

    public $popupHeight;

    public function __construct(
        $src = null,
        $alt = null,
        $class = '',
        $width = null,
        $height = null,
        $loading = 'lazy',
        $responsive = true,
        $rounded = false,
        $thumbnail = false,
        $id = null,
        $style = null,
        $popup = false,
        $popupTitle = null,
        $popupWidth = null,
        $popupHeight = null,
        $attributes = []
    ) {
        $this->src = $src;
        $this->alt = $alt ?? $this->generateAltText($src);
        $this->class = $this->buildClassString($class, $responsive, $rounded, $thumbnail);
        $this->width = $width;
        $this->height = $height;
        $this->loading = $loading;
        $this->responsive = $responsive;
        $this->rounded = $rounded;
        $this->thumbnail = $thumbnail;
        $this->id = $id;
        $this->style = $style;
        $this->popup = $popup;
        $this->popupTitle = $popupTitle ?? $this->alt;
        $this->popupWidth = $popupWidth;
        $this->popupHeight = $popupHeight;
        $this->attributes = $attributes;
    }

    public function render()
    {
        return view('components.image');
    }

    private function buildClassString($baseClass, $responsive, $rounded, $thumbnail)
    {
        $classes = ['img-fluid'];

        if ($responsive) {
            $classes[] = 'img-fluid';
        }

        if ($rounded) {
            $classes[] = 'rounded';
        }

        if ($thumbnail) {
            $classes[] = 'img-thumbnail';
        }

        if ($baseClass) {
            $classes[] = $baseClass;
        }

        return implode(' ', array_unique($classes));
    }

    private function generateAltText($src)
    {
        if (!$src) {
            return '';
        }

        // Extract filename from path
        $filename = basename($src);

        // Remove file extension and replace underscores/dashes with spaces
        $altText = preg_replace('/\.[^.]+$/', '', $filename);
        $altText = str_replace(['_', '-'], ' ', $altText);

        return ucfirst($altText);
    }
}