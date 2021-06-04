<?php namespace App\Console\Commands;

use LaravelAds;
use Illuminate\Console\Command;

class ReportsTest extends Command
{  
    /** 
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:reports {--platform=}';

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

            $accountReport = $googleAds->reports('2021-01-01', '2021-01-05')->getAccountReport();
            $this->info('Account: '.$accountReport->count());

            $campaignReport = $googleAds->reports('2021-01-01', '2021-01-05')->getCampaignReport();
            $this->info('Campaigns: '.$campaignReport->count());

            $adgroupReport = $googleAds->reports('2021-01-01', '2021-01-05')->getAdGroupReport();
            $this->info('AdGroups: '.$adgroupReport->count());
        }

        // test bing api
        if ($platform=='bing') 
        {
            $this->info('BingAds= Account Id: '.$bingAdsID);

            $bingAds = LaravelAds::bingAds()->with($bingAdsID);

            $accountReport = $bingAds->reports('2021-01-01', '2021-01-05')->getAccountReport();
            $this->info('Account: '.$accountReport->count());

            $campaignReport = $bingAds->reports('2021-01-01', '2021-01-05')->getCampaignReport();
            $this->info('Campaigns: '.$campaignReport->count());

            $adgroupReport = $bingAds->reports('2021-01-01', '2021-01-05')->getAdGroupReport();
            $this->info('AdGroups: '.$adgroupReport->count());
        }

    }


}