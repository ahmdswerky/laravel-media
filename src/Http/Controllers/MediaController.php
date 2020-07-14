<?php

namespace AhmdSwerky\Media\Http\Controllers;

use AhmdSwerky\Media\Media;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use AhmdSwerky\Media\Http\Resources\MediaResource;
use AhmdSwerky\Media\Http\Requests\MediaStoreRequest;
use AhmdSwerky\Media\Http\Requests\MediaUpdateRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use AhmdSwerky\Media\Http\Resources\MediaSimpleResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MediaController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(Request $request)
    {
        $media = Media::byModel($request->model, $request->id)->paginate();

        return MediaSimpleResource::collection($media);
    }

    public function store(MediaStoreRequest $request, $model)
    {
        $medium = $request->storeMedia();

        return response([
            'medium' => new MediaResource($medium),
            'message' => __('media::services.media.store', [
                'attribute' => $medium->type,
            ]),
        ]);
    }

    public function show($medium)
    {
        $medium = Media::findOrFail($medium);

        return response([
            'medium' => new MediaResource($medium),
        ]);
    }

    public function update(MediaUpdateRequest $request, $medium)
    {
        $medium = $request->updateMedia();

        return response([
            'medium' => new MediaResource($medium),
            'message' => __('media::services.media.update', [
                'attribute' => $medium->type,
            ]),
        ]);
    }

    public function destroy($medium)
    {
        $medium = Media::findOrFail($medium);
        $type = $medium->type;
        $medium->delete();

        return response([
            'message' => __('media::services.media.delete', [
                'attribute' => $type,
            ]),
        ]);
    }
}
