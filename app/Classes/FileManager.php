<?php
namespace App\Classes;

class FileManager
{
    private $basePath;
    
    protected $path;

    protected $fileName;

    protected $type;
    

    public function __construct($fileName,$path = 'upload',$type = 'json')
    {
        $this->path = $path;
        $this->fileName = $fileName;
        $this->fullPath = "{$this->path}/{$this->fileName}";
        $this->type = $type;
        $this->rootStorage = storage_path('app/');
    }

    protected function mkdir()
    {
        if($this->path)
            \Storage::makeDirectory($this->path);
    }

    public function save($fileContent)
    {
        $this->mkdir();
        \Storage::put("{$this->fullPath}", $fileContent);
        return $this;
    }

    public function getFile()
    {
        switch ($this->type) {
            case 'json':
                $fopen = fopen("{$this->rootStorage}/{$this->fullPath}",'r');
                $fsize = filesize("{$this->rootStorage}/{$this->fullPath}");
                $result = fread($fopen,$fsize);    
                break;
            default:
                # code...
                break;
        }
        return $result;
    }
    public function getFileName()
    {
        return $this->fileName;
    }

}
