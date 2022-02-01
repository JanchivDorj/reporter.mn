<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\SystemCode;
class AutoBanner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cms:banner';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Time finished banner display';

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
        $system_code = SystemCode::where('system_name','banner')->get();
        $onoo = \Carbon\Carbon::now();
        $get_format = str_replace(":",'/',$onoo->format('m:d:Y'));


        $test = "";
        foreach ($system_code as $key => $banner) {

            //$db_onoo = explode('-',$banner->end_date);
           // $onoo = \Carbon\Carbon::now();

            if($banner->end_date < $get_format){
                $system_code = SystemCode::where('id',$banner->id)->update(['active' => '0']);
            }
        }
        
        \Log::info('I was here @'.\Carbon\Carbon::now()."Active:".$test);
    }
}
