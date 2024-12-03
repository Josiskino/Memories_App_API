<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeAction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:action {name : The name of the action} {--path= : The directory to create the action in (relative to app/Actions)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new action class in a specific directory';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $pathOption = $this->option('path');
        $directory = app_path('Actions' . ($pathOption ? '/' . Str::studly($pathOption) : ''));
        $filePath = $directory . '/' . $name . '.php';

        // Ensure the specified directory exists
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        // Check if the file already exists
        if (File::exists($filePath)) {
            $this->error('The action already exists!');
            return Command::FAILURE;
        }

        // Generate the content of the action class
        $content = <<<EOD
<?php

namespace App\Actions\\{$this->getNamespace($pathOption)};

class {$name}
{
    /**
     * Execute the action.
     *
     * @param  array  \$data
     * @return mixed
     */
    public function execute(array \$data)
    {
        // Implement your logic here
    }
}
EOD;

        // Create the action file
        File::put($filePath, $content);
        $this->info("The action {$name} has been created successfully at {$filePath}.");

        return Command::SUCCESS;
    }

    /**
 * Get the namespace based on the provided path.
 *
 * @param  string|null  $pathOption
 * @return string
 */
protected function getNamespace(?string $pathOption): string
{
    return $pathOption ? str_replace('/', '\\', Str::studly($pathOption)) : '';
}

}
