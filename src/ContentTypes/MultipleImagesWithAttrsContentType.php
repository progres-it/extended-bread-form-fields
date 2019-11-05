<?php

namespace ExtendedBreadFormFields\ContentTypes;

use TCG\Voyager\Http\Controllers\ContentTypes\BaseType;
use TCG\Voyager\Http\Controllers\ContentTypes\MultipleImage;

class MultipleImagesWithAttrsContentType extends BaseType
{
    /**
     * @return string
     */
    public function handle()
    {
        $files = [];
        if ($this->request->file($this->row->field)){
            $pathes = (new MultipleImage($this->request, $this->slug, $this->row, $this->options))->handle();
            foreach (json_decode($pathes) as $i => $path) {
                $files[$i]['name'] = $path;
                $files[$i]['order'] = '';
                $files[$i]['alt'] = '';
                $files[$i]['title'] = '';
            }
            usort($files, function ($a, $b) {
                return strcmp($a['order'], $b['order']);
            });
        }
        return json_encode($files);

    }
}
