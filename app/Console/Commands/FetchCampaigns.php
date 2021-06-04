<?php namespace App\Console\Commands;

use LaravelAds;
use Illuminate\Console\Command;

class FetchCampaigns extends Command
{  
    /** 
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:campaigns {--platform=}';

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
            $this->info('GoogleAds= Account Id: '.$googleAdsID);

            $googleAds = LaravelAds::googleAds()->with($googleAdsID);

            // an array of campaigns
            // https://github.com/tmarois/laravel-ads-sdk/blob/master/GoogleAds-SDK.md#fetch-all-campaigns
            $googleCampaigns = $googleAds->fetch()->getCampaigns();

            foreach ($googleCampaigns as $campaign) {
                // do something...
            }

            $this->info('Campaigns Found: '.$googleCampaigns->count());
        }

        // test bing api
        if ($platform=='bing') 
        {
            $this->info('BingAds= Account Id: '.$bingAdsID);

            $bingAds = LaravelAds::bingAds()->with($bingAdsID);

            // an array of campaigns
            // https://github.com/tmarois/laravel-ads-sdk/blob/master/BingAds-SDK.md#fetch-all-campaigns
            $bingCampaigns = $bingAds->fetch()->getCampaigns();

            foreach ($bingCampaigns as $campaign) {
                // do something...
            }

            $this->info('Campaigns Found: '.$bingCampaigns->count());
        }

    }


}