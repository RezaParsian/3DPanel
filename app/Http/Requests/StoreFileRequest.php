<?php

namespace App\Http\Requests;

use App\Models\File;
use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property Project $project
 */
class StoreFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            File::TITLE => ['required', 'string', 'max:256'],
            'file' => ['required', 'file']
        ];
    }

    public function validated($key = null, $default = null)
    {
        return array_merge(parent::validated($key, $default), [
            File::PROJECT_ID => $this->project->id,
            File::PATH => uploadFile($this->file('file'), 'uploads/projects/'),
        ]);
    }
}
