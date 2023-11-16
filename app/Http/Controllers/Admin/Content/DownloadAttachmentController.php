<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Requests\Admin\Content\DownloadAttachment\StoreDownloadAttachmentRequest;
use App\Http\Resources\Admin\Content\DownloadAttachmentResource;
use App\Models\Content\DownloadAttachment;
use App\Support\Http\CrudController;

class DownloadAttachmentController extends CrudController
{
    protected $model = DownloadAttachment::class;

    protected $resource = DownloadAttachmentResource::class;

    protected $requests = [
        'store'  => StoreDownloadAttachmentRequest::class,
        'update' => StoreDownloadAttachmentRequest::class,
    ];

    protected $appends = ['file'];

    protected $media = [
        //key - the name of media name
        //value1 - file type, single for single file upload, multi for something like attachments
        //value2 - collection name if needed
        'file' => 'single|file',
    ];

    protected $sort_by = ['updated_at' => 'desc'];
}
