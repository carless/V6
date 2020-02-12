<?php
namespace Cesi\Core\App\Console;

use Exception;
use Illuminate\Console\Command;
use MatthiasMullie\Minify;

class CompileCesi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cesi:core:compilecesi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compilar los js';

    protected $file_name_ispjs      = 'cesi.isp.js';
    protected $file_name_ispminjs   = 'cesi.isp.min.js';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $file_base_path = base_path() . "/packages/cesi/isp/src";

        $this->info("### CESI\isp Minify JS. Please wait...");

        $file_js    = $file_base_path . '/public/isp/js/' . $this->file_name_ispjs;
        $file_minjs = $file_base_path . '/public/isp/js/' . $this->file_name_ispminjs;

        if (file_exists($file_minjs)) {
            $this->info("Try to delete file:" . $file_minjs );
            unlink($file_minjs);
        }

        try {
            $minifierjs = new Minify\JS($file_js);
            // save minified file to disk
            $minifierjs->minify($file_minjs);

        } catch(Exception $e) {
            $this->error('Error ' . $e->getMessage());
        }
    }
}
