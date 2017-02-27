<?php

namespace App\Http\Controllers;

use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Models\File;

class FilesController extends Controller
{
    private $uploadPath = '\uploads';
    private $mimeTypes = [
        'image/jpeg' => 'jpg',
        'image/pjpeg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif',
        'image/bmp' => 'bmp',
        'video/mp4' => 'mp4',
        'audio/mpeg3' => 'mp3',
        'audio/x-mpeg-3' => 'mp3',
        'video/mpeg' => 'mp3',
        'video/x-mpeg' => 'mp3',
        'application/excel' => 'xls',
        'application/vnd.ms-excel' => 'xls',
        'application/x-excel' => 'xls',
        'application/x-msexcel' => 'xls',
        'application/msword' => 'doc',
        'application/pdf' => 'pdf',
        'application/x-compressed' => 'zip',
        'application/x-zip-compressed' => 'zip',
        'application/zip' => 'zip',
        'multipart/x-zip' => 'zip',
        'application/x-rar-compressed' => 'rar',
        'application/octet-stream' => 'rar'
    ];

    function __construct(){
        $this->user = Sentinel::getUser();
    }

    /**
     * Загрузка файла
     * 
     * @param Request $request
     * @return string
     */
    public function uploadFile(Request $request)
    {
        if ($request->file('file')->isValid()) {
            $file = $request->file('file');

            $mime = $file->getMimeType();
            if(isset($this->mimeTypes[$mime]))
                $type = $this->mimeTypes[$mime];
            else
                return json_encode(['result' => 'error', 'reason' => 'Not supported type']);

            $destinationPath = public_path() . $this->uploadPath;

            if (!is_dir($destinationPath)) {
                mkdir($destinationPath);
            }

            $newFileName = $this->generate_filename($file, $destinationPath);

            $data = [
                'mime' => $mime,
                'original_name' => $file->getClientOriginalName(),
                'original_size' => $file->getClientSize()
            ];

            $file->move($destinationPath, $newFileName);
            $file_obj = new File;
            $id = $file_obj->insertGetId(
                [
                    'user_id' => $this->user->id,
                    'title' => $file->getClientOriginalName(),
                    'href' => $newFileName,
                    'type' => $type,
                    'parent_type' => empty($request->parent_type) ? null : $request->parent_type,
                    'parent_id' => empty($request->parent_id) ? 0 : $request->parent_id,
                    'data' => json_encode($data),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            );

            $saved_file = $file_obj->get_file($id);

            if(in_array($type, ['jpg', 'png', 'gif', 'bmp'])){
                $saved_file->update_image_sizes();
            }

            return response()->success(['file' => [
                'id' => $saved_file->id,
                'title' => $saved_file->title,
                'parent_type' => $saved_file->parent_type,
                'parent_id' => $saved_file->parent_id,
                'thumb_src' => $saved_file->url('thumb'),
                'author' => $saved_file->user->email,
                'data' => json_decode($saved_file->data)
            ]]);
        }

        return response()->error(['reason' => 'File not valid']);
    }

    /**
     * Генерация уникального имени файла
     *
     * @param $file
     * @param string $path
     * @return mixed
     */
    public function generate_filename($file, $path = ''){
        if(empty($path))
            $path = public_path().$this->uploadPath;

        $originalName = $file->getClientOriginalName();

        if(is_file($path.'\\'.$originalName)) {
            $extension = $file->extension();
            $i = 2;
            $originalName = preg_replace('/(.+)(_\(\d+\))?\.'.$extension.'/', '$1_('.$i.').'.$extension, $originalName);
            while(is_file($path.'\\'.$originalName)){
                $originalName = preg_replace('/(.+)(_\(\d+?\))\.'.$extension.'/', '$1_('.$i.').'.$extension, $originalName);
                $i++;
            }
        }

        return $originalName;
    }

    /**
     * Отдача файлов для админки
     *
     * @param Request $request
     * @param File $file
     * @return mixed
     */
    public function getFiles(Request $request, File $file){
        $count = empty($request->count) ? 10 : (int)$request->count;
        $offset = empty($request->offset) ? 0 : (int)$request->offset;
      
        $files = $file->take($count)->offset($offset)->orderBy('id', 'DESC')->get();
        $data = [];
        foreach ($files as $key => $file){
            $data[] = [
                'id' => $file->id,
                'title' => $file->title,
                'parent_type' => $file->parent_type,
                'parent_id' => $file->parent_id,
                'thumb_src' => $file->url('thumb'),
                'author' => $file->user->email,
                'data' => json_decode($file->data)
            ];
        }
        return response($data);
    }

    /**
     * Дополнительная информация о файлах
     *
     * @param Request $request
     * @param File $file
     * @return mixed
     */
    public function getFilesInfo(Request $request, File $file){
        return response([
            'count' => $file->all()->count(),
            'types' => config('image.types'),
            'sizes' => config('image.sizes')
        ]);
    }

    /**
     * Обновление файла
     *
     * @param $id
     * @param Request $request
     * @param File $files
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateFile($id, Request $request, File $files){
        $this->validate($request, [
            'id' => 'required'
        ]);

        $file = $files->get_file($id);
        $file->title = $request->input('title');
        $file->parent_type = $request->input('parent_type');
        $file->save();

        return response()->success(compact('post'));
    }

    /**
     * Удаление файла
     *
     * @param $id
     * @param File $files
     * @return mixed
     */
    public function deleteFile($id, File $files){
        $file = $files->get_file($id);
        if ($file !== null) {
            $file_data = json_decode($file->data);
            $created_sizes = isset($file_data->sizes) && !empty($file_data->sizes) ? $file_data->sizes : array();

            foreach ($created_sizes as $size => $data) {
                $path = public_path() . $this->uploadPath . '\\' . $data->href;
                if (is_file($path))
                    unlink($path);
            }

            $path = public_path() . $this->uploadPath . '\\' . $file->href;
            if (is_file($path))
                unlink($path);

            $files->remove_file($id);
            return response()->success($file);
        } else {
            return response()->error(['reason' => 'File not exist']);
        }
    }
}
