<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class runSendNewletter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

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
     * @return mixed
     */
    public function handle()
    {
        $carbon = new Carbon();
        $listnewletters = Newletter::getListNewleterSendAuto($carbon->today()->format("Y-m-d"));
        //Lay ds dang ky nhan newletter da duoc duyet
        $dsguithu = NhanBaiViet::getNhanBaiVietByStatus();
        if (!is_null($listnewletters)) {
            foreach ($listnewletters as $list) {
                //Lay chi tiet dot gui thu
                $newsletter = Newletter::getNewletter($list->Id);
                //vong lap
                if (!is_null($dsguithu)) {
                    foreach ($dsguithu as $nguoi) {
                        try {
                            EmailController::sendNewletter($newsletter->TieuDe, $newsletter->NoiDung, $newsletter->UrlTrack, $newsletter->Id, $nguoi->Id, $nguoi->Email);
                            //Luu du lieu vao bang chitiet_newsletter
                            $ctiet = array(
                                "IdNewsLetter" => $newsletter->Id,
                                "IdDangKy" => $nguoi->Id,
                            );
                            Newletter::saveChiTietNewletter($ctiet);
                        } catch (\Exception $ex) {
                            Log::error($ex->getMessage());
                        }
                    }
                    //cap nhat lai trang thai cua newsletter
                    Newletter::updateNewletter(array("TrangThai" => 1), array("Id" => $newsletter->Id));
                }
            }
        }
    }
}
