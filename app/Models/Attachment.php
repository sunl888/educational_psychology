<?php

namespace App\Models;


class Attachment extends BaseModel
{
    protected $fillable = ['post_id', 'uploader_id', 'file_name', 'mime', 'file_size', 'path'];

}
