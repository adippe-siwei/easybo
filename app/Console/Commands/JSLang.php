<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class JSLang extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jslang:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $langFolderList = base_path('resources/lang/');
        foreach (glob($langFolderList . '/*', GLOB_ONLYDIR) as $dir) {
            $lang = basename($dir);
            $langFolderPath = $langFolderList . $lang;
            if (file_exists($langFolderPath . '/jslang.php')) {
                $messages = include $langFolderPath . '/jslang.php';
                $i18nPath = public_path("i18n/$lang.js");
                unlink($i18nPath);

                $f = fopen($i18nPath, 'w+');
                foreach ($messages as $key => $message) {
                    fputs($f, 'let ' . $key . ' = "' . $message . '";' . "\r\n");
                }
                fclose($f);
            }
        }
        return 0;
    }
}
