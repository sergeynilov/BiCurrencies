<?php

namespace App\Console\Commands;

use App\Models\Currency;
use App\Models\CMSItem;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class prepareMediaForStorage extends Command
{
    // php artisan  command:prepareMediaForStorage
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:prepareMediaForStorage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $fd = fopen('media_git.txt', "a+");


        $currencies = Currency
            ::orderBy('id', 'asc')
            ->get();
        foreach ($currencies as $nextCurrency) {
            foreach ($nextCurrency->getMedia(config('app.media_app_name')) as $mediaImage) {
                if (File::exists($mediaImage->getPath())) {
                    fwrite($fd,
                        ' git add -f    storage/app/public/' . config('app.media_app_name') . '/' . $mediaImage->id . '/' . $mediaImage->file_name . chr(13));
                } else {
                    echo 'File ' . $mediaImage->getPath() . " skipped \r\n";
                }
            }
        }


        $users = User
            ::orderBy('id', 'asc')
            ->get();
        foreach ($users as $nextUser) {
            foreach ($nextUser->getMedia(config('app.media_app_name')) as $mediaImage) {
                if (File::exists($mediaImage->getPath())) {
                    fwrite($fd,
                        ' git add -f    storage/app/public/' . config('app.media_app_name') . '/' . $mediaImage->id . '/' . $mediaImage->file_name . chr(13));
                } else {
                    echo 'File ' . $mediaImage->getPath() . " skipped \r\n";
                }
            }
        }


        $cMSItems = CMSItem
            ::orderBy('id', 'asc')
            ->get();
        foreach ($cMSItems as $nextCMSItem) {
            foreach ($nextCMSItem->getMedia(config('app.media_app_name')) as $mediaImage) {
                if (File::exists($mediaImage->getPath())) {
                    fwrite($fd,
                        ' git add -f    storage/app/public/' . config('app.media_app_name') . '/' . $mediaImage->id . '/' . $mediaImage->file_name . chr(13));
                } else {
                    echo 'File ' . $mediaImage->getPath() . " skipped \r\n";
                }
            }
        }



        fclose($fd);

        return 0;
    }
}
