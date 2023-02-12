<?php

namespace App\Class;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class CrudManager
{
    public string $modelName;
    public array $fieldsModel;
    public string $refRoutes = '## References Routes';
    public string $refUses = '## References Use';

    public function __construct($modelName, $fieldsModel)
    {
        $this->fieldsModel = $fieldsModel;
        $this->modelName = $modelName;
    }

    public function create()
    {
        $this->createNewModel(ucfirst($this->modelName));
        $this->createNewController(ucfirst($this->modelName));
        /* $this->webRoutes(); */
        dd('finish');
    }

    public function createNewModel($modelName)
    {
        // Define the file path and name
        $filePath = app_path('Models/' . $modelName . '.php');

        // Check if the file already exists
        if (File::exists($filePath)) {
            return response('Model already exists', 400);
        }
        // Create the Model file and write to it
        File::put($filePath, <<<EOT
        <?php

        namespace App\Models;

        use Illuminate\Database\Eloquent\Factories\HasFactory;
        use Illuminate\Database\Eloquent\Model;

        class {$modelName} extends Model
        {
            use HasFactory;

            protected \$guarded = [];
        }
        EOT);

        return response('Model created', 200);
    }

    public function createNewController($controllerName)
    {
        // Define the file path and name
        $filePath = app_path('Http/Controllers/' . $controllerName . 'Controller.php');

        // Create the controller file and write to it
        File::put($filePath, <<<EOT
        <?php
        namespace App\Http\Controllers;

        class $controllerName extends Controller
        {
            public function index()
            {
                return view('admin.pages.$controllerName"."s.index');
            }

            public function create()
            {
                return view('admin.pages.$controllerName.create');
            }
        }
        EOT
        );
        return response('Controller created', 200);
    }

    public function webRoutes()
    {
        $this->createCrudRoutesFolderAndFile();
        $this->includeCrudRoutesWeb();
        $this->writeNewRoutesWeb($this->modelName);
        $this->createMigrations($this->modelName);
    }

    public function createCrudRoutesFolderAndFile()
    {
        $filePath = base_path('routes/CrudManager/routes.php');
        $directory = dirname($filePath);

        // Create directory if it does not exist
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        // Create file if it does not exist and write base Code
        if (!File::exists($filePath)) {

            $code = <<<EOT
            <?php

            {$this->refUses}
            use Illuminate\Support\Facades\Route;

            Route::middleware([
                'auth:sanctum',
                config('jetstream.auth_session'),
                'verified',
            ])->group(function () {
                Route::prefix('admin')->group(function () {
                    {$this->refRoutes}
                });
            });
            EOT;

            File::put($filePath, $code);
        }
    }

    public function includeCrudRoutesWeb()
    {
        $filePath = base_path('routes/web.php');
        $contents = file_get_contents($filePath);
        $searchTerm = "include('./CrudManager/routes.php');";
        $pos = strpos($contents, $searchTerm);

        if ($pos === false) {
            // Open the file for writing in append mode
            $file = fopen($filePath, "a");

            // Write some lines to the end of the file
            fwrite($file, "\n" . $searchTerm);

            // Close the file
            fclose($file);
        }
    }

    public function writeNewRoutesWeb($modelName)
    {
        $filePath = base_path('routes/CrudManager/routes.php');
        $contents = file_get_contents($filePath);
        $searchTerm = $this->refRoutes;
        $modelNameCapitalized = ucfirst($modelName);

        $ControllerExist = app_path('Http/Controllers/ArticleController');

        // Check if the file already exists
        if (File::exists($ControllerExist)) {
            return response('Controller already exists', 400);
        }

        if (!$filePath) {
            $newContent = <<<EOT
            \n\t\tRoute::get('/', [{$modelNameCapitalized}Controller::class, 'index'])->name('admin.{$modelName}s.index');
            \t\tRoute::get('/create',  [{$modelNameCapitalized}Controller::class, 'index'])->name('admin.{$modelName}.create');
            EOT;

            $pos = strpos($contents, $searchTerm);

            if ($pos) {
                // Split the string into two parts
                $before = substr($contents, 0, $pos + strlen($searchTerm));
                $after = substr($contents, $pos + strlen($searchTerm));

                // Insert the new phrase after the search term
                $before .= $newContent;

                // Concatenate the two parts back together
                $newContent = $before . $after;

                // Write the modified contents back to the file
                file_put_contents($filePath, $newContent);
            }
        }
    }

    public function createMigrations()
    {
        Artisan::call('make:migration create_' . $this->modelName . 's_table ' . $this->modelName);
    }
}
