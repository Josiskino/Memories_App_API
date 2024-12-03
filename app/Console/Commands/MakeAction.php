<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeAction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:action {name : The name of the action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new action class';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $directory = app_path('Actions');
        $filePath = $directory . '/' . $name . '.php';

        // Ensure the Actions directory exists
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

namespace App\Actions;

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
        $this->info("The action {$name} has been created successfully.");

        return Command::SUCCESS;
    }
}
