<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Img;

class File extends Model
{
    private $uploadPath = '/uploads';

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Получение файла по id
     *
     * @param int $id Id файла
     * @return object
     */
    public function get_file($id)
    {
        return $this->where('id', $id)
            ->take(1)
            ->get()
            ->first();
    }

    /**
     * Удаление файла по id
     *
     * @param int $id Id файла
     * @return mixed
     */
    public function remove_file($id)
    {
        return $this->where('id', $id)
            ->delete();
    }

    /**
     * Получение необновлённого изображения
     *
     * @param string $date Время начала обновления
     * @return object
     */
    public function get_not_updated_image($date)
    {
        return $this->where('updated_at', '<', $date)
            ->where('type', 'image')
            ->orderBy('id', 'asc')
            ->take(1)
            ->get()
            ->first();
    }

    /**
     * Колличество обновлённых изображений
     *
     * @param string $date Время начала обновления
     * @return mixed
     */
    public function get_updated_images_count($date)
    {
        return $this->where('updated_at', '>=', $date)
            ->where('type', 'image')
            ->count();
    }

    /**
     * Прогресс обновления изображений
     *
     * @param string $date Время начала обновления
     * @return mixed
     */
    public function get_updating_progress($date)
    {
        $count = $this->where('type', 'image')->count();
        $updated = $this->get_updated_images_count($date);
        $progress = floor($updated/$count*100);
        return $progress;
    }

    /**
     * Обновление размеров изображения
     *
     * @param int $id
     * @param array $sizes
     */
    public function update_images_sizes($id, $sizes)
    {
        $file = $this->get_file($id);
        $data = json_decode($file->data, true);
        $data['sizes'] = $sizes;
        $this->update_file_data($id, $data);
    }

    /**
     * Обновление вспомогательных данных файла
     *
     * @param int $id
     * @param array $data
     */
    public function update_file_data($id, $data){
        $this->where('id', $id)
            ->update(['data' => json_encode($data)]);
    }

    /**
     * Получение нужного размера изображения
     *
     * @param int|array|object $image id, массив, объект изображения
     * @param string|array $size Размер изображения ('full', 'product', 'product_list', 'blog', [100, 100])
     * @return string Абсолютный путь к изображению
     */
    public function get_image_url($image, $size = 'full')
    {
        if(is_object($image))
            $image = $image->toArray();
        elseif(is_int($image))
            $image = $this->where('id', $image)
                ->where('type', 'image')
                ->take(1)
                ->get()
                ->first()
                ->toArray();

        if($size == 'full'){
            return $this->uploadPath . '/' . $image['href'];
        }

        $img_sizes = json_decode($image['sizes']);

        if(is_array($size)){
            foreach ($img_sizes as $img_size){
                if($img_size['w'] == $size[0] && $img_size->h == $size[1])
                    return $this->uploadPath . '/' . $img_size->href;
            }
            foreach ($img_sizes as $img_size){
                if($img_size['w'] >= $size[0] && $img_size->h >= $size[1])
                    return $this->uploadPath . '/' . $img_size->href;
            }
        }else{
            if(isset($img_sizes->$size)){
                return $this->uploadPath . '/' . $img_sizes->$size->href;
            }
        }

        return $this->uploadPath . '/' . $this->href;
    }

    /**
     * Получение пути к файлу / к нужному размеру текущего изображения
     *
     * @param string|array $size Размер изображения ('full', 'product', 'product_list', 'blog', [100, 100])
     * @return string Абсолютный путь к изображению
     */
    public function url($size = 'full')
    {
        if($this->type == 'image')
            return $this->get_file_url($this, $size);
        else
            return $this->uploadPath . '/' . $this->href;
    }

    /**
     * Используется ли файл
     *
     * @param int $id Id файла
     * @return bool
     */
    public function is_used($id)
    {
        return (bool) $this->where('id', $id)
            ->notNull('parent')
            ->count();
    }

    /**
     * Получение id файла по его имени
     *
     * @param $title
     * @return int
     */
    public function get_id_by_title($title)
    {
        $file = $this->select('id')
            ->where('title', $title)
            ->take(1)
            ->first();

        if($file == null)
            return 0;
        else
            return $file->id;
    }

    /**
     * Получение предустановленных размеров для данного типа изображения
     *
     * @return array
     */
    public function get_image_type_sizes(){
        $image_types = config('image.types');
        $image_type_data = isset($image_types[$this->parent_type])?$image_types[$this->parent_type]:$image_types['default'];
        $image_sizes = [];
        if(isset($image_type_data['sizes'])){
            foreach ($image_type_data['sizes'] as $size){
                $image_sizes[$size] = config("image.sizes.$size");
            }
        }else{
            $image_sizes = config("image.sizes");
        }
        return $image_sizes;
    }

    /**
     * Обновление размеров изображения
     */
    public function update_image_sizes()
    {
        $image_data = $this->toArray();
        $data = json_decode($image_data['data'], true);
        $created_sizes = isset($data['sizes']) ? $data['sizes'] : [];
        if(!is_array($created_sizes))
            $created_sizes = [];

        // Получение настроек
        $registered_sizes = $this->get_image_type_sizes();

        // Удаление лишних изображений
        foreach ($created_sizes as $size => $data){
            if(!isset($registered_sizes[$size]) || isset($data['href']) && ($data['w'] != $registered_sizes[$size]['width'] || $data['h'] != $registered_sizes[$size]['height'])){
                $path = public_path('assets/images/' . $data['href']);
                if(is_file($path))
                    unlink($path);
                unset($created_sizes[$size]);
            }
        }

        // Создание новых изображений
        foreach ($registered_sizes as $size => $data){
            if(!isset($created_sizes[$size]))
                $created_sizes[$size] = array('w' => 0, 'h' => 0);

            if($created_sizes[$size]['w'] != $data['width'] || $created_sizes[$size]['h'] != $data['height']){
                $new_file = $this->update_image_size($image_data['href'], $data['width'], $data['height'], 'crop');

                if(!empty($new_file)) {
                    $created_sizes[$size]['href'] = $new_file;
                    $created_sizes[$size]['w'] = $data['width'];
                    $created_sizes[$size]['h'] = $data['height'];
                }else{
                    unset($created_sizes[$size]);
                }
            }
        }

        $this->update_images_sizes($image_data['id'], $created_sizes);
    }

    /**
     * Создание изображения заданного размера
     *
     * @param string $href Имя файла
     * @param int $w Ширина
     * @param int $h Высота
     * @param string $method (contain|cover|crop)/(уместить/заполнить/обрезать)
     * @return string Имя созданного файла
     */
    public function update_image_size($href, $w, $h, $method = 'contain')
    {
        $name_parts = explode('.', $href);
        $extension = end($name_parts);

        $path = public_path($this->uploadPath . '/' . $href);
        $new_name = '';

        $image = Img::make($path);
        $original_width = $image->width();
        $original_height = $image->height();

        if(($original_width < $w && $original_height < $h) || ($method != 'contain' && ($original_width < $w || $original_height < $h)))
            return $new_name;

        if($original_width/$w > $original_height/$h) {
            switch ($method) {
                case 'contain':
                    $image->resize($w, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $new_name = $this->save_image_file($image, $original_width, $original_height, $w, $image->height(), $extension, $href);
                    break;
                case 'cover':
                    $image->resize(null, $h, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $new_name = $this->save_image_file($image, $original_width, $original_height, $image->width(), $h, $extension, $href);
                    break;
                case 'crop':
                    $image->resize(null, $h, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $new_name = $this->save_image_file($image, $original_width, $original_height, $w, $h, $extension, $href, 'crop');
                    break;
            }
        }elseif($original_width/$w < $original_height/$h) {
            switch ($method) {
                case 'contain':
                    $image->resize(null, $h, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $new_name = $this->save_image_file($image, $original_width, $original_height, $image->width(), $h, $extension, $href);
                    break;
                case 'cover':
                    $image->resize($w, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $new_name = $this->save_image_file($image, $original_width, $original_height, $w, $image->height(), $extension, $href);
                    break;
                case 'crop':
                    $image->resize($w, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $new_name = $this->save_image_file($image, $original_width, $original_height, $w, $h, $extension, $href, 'crop');
                    break;
            }

        }else {
            $new_name = $this->save_image_file($image, $original_width, $original_height, $w, $h, $extension, $href, 'resize');
        }
        return $new_name;
    }

    /**
     * Сохранение копии изображения
     *
     * @param $image
     * @param $original_width
     * @param $original_height
     * @param $result_width
     * @param $result_height
     * @param $extension
     * @param $href
     * @param string $method
     * @return string
     */
    public function save_image_file($image, $original_width, $original_height, $result_width, $result_height, $extension, $href, $method = ''){
        if($original_width != $result_width || $original_height != $result_height){
            $new_name = str_replace('.'.$extension, '_'.$result_width.'x'.$result_height.'.'.$extension, $href);
            $new_path = public_path($this->uploadPath . '/' . $new_name);
            switch ($method) {
                case 'resize':
                    $image->resize($result_width, $result_height)->save($new_path);
                    break;
                case 'crop':
                    $image->crop($result_width, $result_height)->save($new_path);
                    break;
                default:
                    $image->save($new_path);
            }
            return $new_name;
        }else{
            return '';
        }
    }
}
