<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use App\Http\Resources\FileResource;
use App\Http\Resources\FileResourceCollection;
use App\Models\File;
use App\Models\Project;
use Illuminate\Support\Facades\Route;
use Rp76\LaravelPack\Pipes\SortPipe;

class FileController extends Controller
{
    public static function routes(): void
    {
        Route::group(['prefix' => 'files', 'middleware' => 'auth:sanctum'], function () {
            Route::get('{project}', [self::class, 'index']);
            Route::post('{project}', [self::class, 'store']);

            Route::get('file/{file:code}', [self::class, 'show'])->withoutMiddleware('auth:sanctum');

            Route::put('{project}/file/{file}', [self::class, 'update']);
            Route::delete('{project}/file/{file}', [self::class, 'destroy']);
        });
    }

    public function index($id)
    {
        $files = File::where(File::PROJECT_ID, $id)
            ->select(['id', 'project_id', 'title', 'path','code', 'created_at'])
            ->with('project')
            ->pipe([
                SortPipe::class
            ])->page();

        return success(FileResourceCollection::make($files));
    }

    public function store(StoreFileRequest $request, Project $project)
    {
        File::create($request->validated());

        return success(null, status: 201);
    }

    public function show( Project $project, File $file)
    {
        return success(FileResource::make($file));
    }

    public function update(UpdateFileRequest $request, Project $project, File $file)
    {
        $file->update($request->validated());
        return success(null, status: 202);
    }

    public function destroy(Project $project, File $file)
    {
        \Illuminate\Support\Facades\File::delete($file->path);

        $file->delete();
        return success(null, status: 202);
    }
}
