<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class visitors extends Model
{
    protected $table = "visitors";
    private $id;
    private $ip;
    private $last_time_activation;
    private $accessing_count;

    public function __construct($id = null, $ip = null, $last_time_activation = null, $accessing_count = null) {
        $this->id = $id;
        $this->ip = $ip;
        $this->last_time_activation = $last_time_activation;
        $this->accessing_count = $accessing_count;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIp($ip) {
        $this->ip = $ip;
    }

    function setLast_time_activation($last_time_activation) {
        $this->last_time_activation = $last_time_activation;
    }

    function getId() {
        return $this->id;
    }

    function getLast_time_activation() {
        return $this->last_time_activation;
    }

    function getIp() {
        return $this->ip;
    }

    function getAccessing_count() {
        return $this->accessing_count;
    }

    function setAccessing_count($accessing_count) {
        $this->accessing_count = $accessing_count;
    }

    public function get($ip = null, $device = null) {
        if ($ip != null) {
            $rows = DB::table("visitors")->where("ip", $ip)->where("device", $device)->get();
            if (!is_null($rows)) {
                $visitor = new visitors();
                foreach ($rows as $key => $value) {
                    $visitor->setId($value->id);
                    $visitor->setIp($value->ip);
                    $visitor->setLast_time_activation($value->last_time_activation);
                    $visitor->setAccessing_count($value->accessing_count);
                    return $visitor;
                }
            } else {
                return 0;
            }
        } else {
            $total = DB::table("visitors")->sum("accessing_count");
            return $total;
        }
    }

    public function set($ip, $device) {
        return DB::table("visitors")->insert(array("ip" => $ip, "device" => $device));
    }

    public function show() {
        $this->total = $this->get();
        $ip = $_SERVER['REMOTE_ADDR'];
        $device = $_SERVER['HTTP_USER_AGENT'];
        $this->curvisitor = $this->get($ip, $device);

        if ($this->curvisitor != NULL) {
            $diff_time = (time() - strtotime($this->curvisitor->getLast_time_activation())) / (60 * 10);
            if ($diff_time >= 1) {
                $this->total += 1;
                DB::table("visitors", array("last_time_activation" => date("Y-m-d H:i:s", time()), "accessing_count" => intval($this->curvisitor->getAccessing_count()) + 1), array("ip" => $ip, "device" => $device));
            }
        } else {//new visitor
            $this->set($ip, $device);
        }
        return $this->total;
    }

    //Ham dem tong so luot truy cap
    public function countVisitor() {
        $imagetype = "1/";           # 1 to 10 = The type of image to display (SEE README FILE)
        ## --  END OF CONFIG SECTION  --  ##

        $imagefolder = "digits/";    # The full path to the images directory.
        ## Get the hitslog file ready
        $hits = $this->show();

        ## If Image Counter, get the required type and print them out.
        $digit = strval($hits);
        $str = "";
        for ($i = 0; $i < strlen($hits); $i++) {
            $str .= "<img src='" . url($imagefolder . $imagetype . $digit[$i].".gif") . "'>";
        }
        return $str;
    }
}
