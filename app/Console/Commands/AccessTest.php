<?php namespace App\Console\Commands;

use LaravelAds;
use Illuminate\Console\Command;

class AccessTest extends Command
{  
    /** 
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'access {--platform=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // these are for testing purposes
        // be sure to use your own account IDs
        $googleAdsID = env("GOOGLEID",'');
        $bingAdsID   = env("BINGID",'');

        // which platform are we testing??
        // "google" or "bing"
        $platform = $this->option('platform');

        // test google api
        if ($platform=='google') 
        {
            $this->info('GoogleAds');
            $this->info('Account Id: '.$googleAdsID);

            $googleAds = LaravelAds::googleAds()->with($googleAdsID);
            $googleCampaigns = $googleAds->fetch()->getCampaigns();

            $this->info('Campaigns Found: '.count($googleCampaigns));
        }

        // test bing api
        if ($platform=='bing') 
        {
            $this->info('BingAds');
            $this->info('Account Id: '.$bingAdsID);

            $bingAds = LaravelAds::bingAds()->with($bingAdsID);
            $bingCampaigns = $bingAds->fetch()->getCampaigns();

            $this->info('Campaigns Found: '.count($bingCampaigns));
        }

    }


}