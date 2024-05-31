<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\ProjectResourceCollection;
use App\Models\Project;
use Illuminate\Support\Facades\Route;
use Rp76\LaravelPack\Pipes\MinePipe;
use Rp76\LaravelPack\Pipes\SortPipe;

class ProjectController extends Controller
{
    public static function routes(): void
    {
        Route::group(['prefix' => 'projects', 'middleware' => 'auth:sanctum'], function () {
            Route::get('', [self::class, 'index']);
            Route::post('', [self::class, 'store']);

            Route::put('{project}', [self::class, 'update']);
            Route::delete('{project}', [self::class, 'destroy']);
        });
    }

    public function index()
    {
        $projects = Project::pipe([
            MinePipe::class,
            SortPipe::class
        ])->page();

        return success(ProjectResourceCollection::make($projects));
    }

    public function store(ProjectStoreRequest $request)
    {
        return success(ProjectResource::make(Project::create($request->validated())), status: 201);
    }

    public function update(Project $project, ProjectStoreRequest $request)
    {
        $project->update($request->validated());
        return success(null, status: 202);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return success(null, status: 202);
    }
}
