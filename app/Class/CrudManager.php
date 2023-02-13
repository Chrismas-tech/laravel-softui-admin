<?php

namespace App\Class;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class CrudManager
{
    public string $modelName;
    public string $controllerName;
    public array $fieldsModel;
    public string $refRoutes = '## References Routes';
    public string $refUses = '## References Use';

    public function __construct($modelName, $fieldsModel)
    {
        $this->fieldsModel = $fieldsModel;
        $this->modelName = $modelName;
        $this->controllerName = ucfirst($this->modelName) . 'Controller';
    }

    public function create()
    {
        $this->createNewModel(ucfirst($this->modelName));
        $this->createMigration();
        $this->runMigration();
        $this->createNewController(ucfirst($this->modelName));
        $this->crudWebRoutes($this->modelName);
        dd('finish');
    }

    public function createNewModel($modelName)
    {
        // Define the file path and name
        $filePath = app_path('Models/' . $modelName . '.php');

        // Check if the file already exists
        if (File::exists($filePath)) {
            return abort(505, 'The model already exists !');
        } else {
            // Create the Model file and write to it
            File::put($filePath, <<<EOT
        <?php

        namespace App\Models;

        use Illuminate\Database\Eloquent\Factories\HasFactory;
        use Illuminate\Database\Eloquent\Model;

        class $modelName extends Model
        {
            use HasFactory;

            protected \$guarded = [];
        }
        EOT);
        }
    }

    public function createNewController()
    {
        // Define the file path and name
        $filePath = app_path('Http/Controllers/' . $this->controllerName . '.php');

        $modelName = $this->modelName . 's';

        // Create the controller file and write to it
        File::put(
            $filePath,
            <<<EOT
        <?php
        namespace App\Http\Controllers;

        class $this->controllerName extends Controller
        {
            public function index()
            {
                return view('admin.pages.$modelName.index');
            }

            public function create()
            {
                return view('admin.pages.$modelName.create');
            }
        }
        EOT
        );
    }

    public function crudWebRoutes()
    {
        /* dd('test 1'); */
        $this->createCrudRoutesFolderAndFile();
        $this->includeCrudRoutesWeb();
        $this->writeNewRoutesWeb($this->modelName);
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

            $this->refUses
            use Illuminate\Support\Facades\Route;

            Route::middleware([
                'auth:sanctum',
                config('jetstream.auth_session'),
                'verified',
            ])->group(function () {
                Route::prefix('admin')->group(function () {
                    $this->refRoutes
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

    public function writeNewRoutesWeb()
    {
        $filePath = base_path('routes/CrudManager/routes.php');
        $contents = file_get_contents($filePath);
        $searchTerm = $this->refRoutes;
        $modelNameCapitalized = ucfirst($this->modelName);


        $newContent = <<<EOT
            \n\t\tRoute::get('/', [{$modelNameCapitalized}Controller::class, 'index'])->name('admin.{$this->modelName}s.index');
            \t\tRoute::get('/create',  [{$modelNameCapitalized}Controller::class, 'index'])->name('admin.{$this->modelName}.create');
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

    public function createMigration()
    {

        foreach ($this->fieldsModel as $field) {
        }

        // Set the name of the table to create
        $tableName = $this->modelName . 's';

        // Get the current date and time in the format of "Y_m_d_His"
        $timestamp = date('Y_m_d_His');

        // Combine the parts to create the migration file name
        $fileName = $timestamp . '_create_' . $tableName . '_table.php';

        // Create the full path for the new migration file
        $filePath = database_path('migrations/' . $fileName);

        // Define the content of the migration file
        $content = <<<EOD
        <?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;

        return new class extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create('$tableName', function (Blueprint \$table) {
                    \$table->id();
        EOD;

        foreach ($this->fieldsModel as $field) {
            $content .= <<<EOD
                        \n\t\t\t\$table->$field[1]('$field[2]');
                    EOD;
        }
        $content .= <<<EOD
                    \n\t\t\t\$table->timestamps();
                });
            }

            /**
             * Reverse the migrations.
             *
             * @return void
             */
            public function down()
            {
                Schema::dropIfExists('$tableName');
            }
        };
        EOD;

        // Write the new migration file to the migrations directory
        file_put_contents($filePath, $content);
    }

    public function runMigration()
    {
        Artisan::call('migrate');
    }
}
