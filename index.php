<?php
include('datas.php');
include('config.php');
include('sql.php');
$action=array_filter(explode("/",isset($_GET['action'])?$_GET['action']:''));
if(!isset($action[0])){$action[0]='anasayfa';}
$realPath="app/main/";
	
if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}
function convertTime($time, $type = 0, $minute = false)
{
    $time = strtotime($time);
    if ($type === 0) {
        $timeDifference = time() - $time;
        $second = $timeDifference;
        $minute = round($timeDifference / 60);
        $hour = round($timeDifference / 3600);
        $day = round($timeDifference / 86400);
        $week = round($timeDifference / 604800);
        $month = round($timeDifference / 2419200);
        $year = round($timeDifference / 29030400);
        if ($second < 60) {
            if ($second === 0) {
                return " az önce";
            }
            return $second . " saniye önce";
        }
        if ($minute < 60) {
            return $minute . " dakika önce";
        }
        if ($hour < 24) {
            return $hour . " saat önce";
        }
        if ($day < 7) {
            return $day . " gün önce";
        }
        if ($week < 4) {
            return $week . " hafta önce";
        }
        if ($month < 12) {
            return $month . " ay önce";
        }
        return $year . " yıl önce";
    }
    if ($type === 1) {
        if ($minute === true) {
            return date("d.m.Y H:i", $time);
        }
        return date("d.m.Y", $time);
    }
    if ($type === 2) {
        if ($minute === true) {
            $date = date("d.m.Y H:i", $time);
        } else {
            $date = date("d.m.Y", $time);
        }
        $date = explode(".", $date);
        list($day, $month, $year) = $date;
        if ($month === "01") {
            $month = "Ocak";
        }
        if ($month === "02") {
            $month = "Şubat";
        }
        if ($month === "03") {
            $month = "Mart";
        }
        if ($month === "04") {
            $month = "Nisan";
        }
        if ($month === "05") {
            $month = "Mayıs";
        }
        if ($month === "06") {
            $month = "Haziran";
        }
        if ($month === "07") {
            $month = "Temmuz";
        }
        if ($month === "08") {
            $month = "Ağustos";
        }
        if ($month === "09") {
            $month = "Eylül";
        }
        if ($month === "10") {
            $month = "Ekim";
        }
        if ($month === "11") {
            $month = "Kasım";
        }
        if ($month === "12") {
            $month = "Aralık";
        }
        if ($minute === true) {
            $clock = explode(":", explode(" ", $year)[1]);
            list($minute, $second) = $clock;
            return sprintf("%02d %s %04d %02d:%02d", $day, $month, $year, $minute, $second);
        }
        return sprintf("%02d %s %04d", $day, $month, $year);
    }
    return false;
}
switch($action[0]){
    case "anasayfa":
        $sotitle = "Ana Sayfa";
        $sodesc="OYUN SUNUCULARI VE DAHA FAZLASI";
        $sokw="oyun,sunuculari,sunucucoplugu,kurumsal,webhosting,ucuz,kaliteli,almanya,turkiye,lokasyon";
        break;
    case "hosting":
        $sotitle = "Hosting";
        $sodesc="2x Hızında çalışan uygun fiyatlı ve kaliteli hosting paketlerimiz!";
        $sokw="oyun,sunuculari,sunucucoplugu,kurumsal,webhosting,ucuz,kaliteli,almanya,turkiye,lokasyon";
        break;
    case "404":
        $sotitle = "Hata";
        $sodesc="OoOps! Whuuh";
        $sokw="oyun,sunuculari,sunucucoplugu,kurumsal,webhosting,ucuz,kaliteli,almanya,turkiye,lokasyon";
        break;
    case "sanal":
        $sotitle = "Sanal Sunucular";
        $sodesc="Sunucularda kullanılan ssd diskimiz ile birlikte uygun fiyata çok hızlı ve kaliteli e5-2690v2 işlemciye sahip bir cihaza sahip olabilirsiniz.";
        $sokw="oyun,sunuculari,sunucucoplugu,kurumsal,webhosting,ucuz,kaliteli,almanya,turkiye,lokasyon,kaliteli,islemci,vds,vps,sunucu";

        break;
    case "gizlilik-sozlesmesi":
        $sotitle = "Gizlilik Sözleşmesi";
        $sodesc="Gizlilik Sözleşmesi";
        $sokw="oyun,sunuculari,sunucucoplugu,kurumsal,webhosting,ucuz,kaliteli,almanya,turkiye,lokasyon";

        break;
    case "kullanim-sartlari":
        $sotitle="Kullanım Şartları";
        $sodesc="Kullanım Şartları";
        $sokw="oyun,sunuculari,sunucucoplugu,kurumsal,webhosting,ucuz,kaliteli,almanya,turkiye,lokasyon";

        break;
    case "iletisim":
        $sotitle="İletişim";
        $sodesc="İletişim";
        $sokw="oyun,sunuculari,sunucucoplugu,kurumsal,webhosting,ucuz,kaliteli,almanya,turkiye,lokasyon";

        break;
    case "game":
        switch ($action[1]){
            case "minecraft":
                $sotitle="Minecraft Sunucuları";
                $sodesc="Sunucularda kullanılan ssd diskimiz ile birlikte uygun fiyata çok hızlı ve kaliteli Ryzen 9 3900X veya E5-2690 v2 işlemciye sahip bir Minecraft cihazına sahip olabilirsiniz.";
                $sokw="oyun,sunuculari,sunucucoplugu,kurumsal,webhosting,ucuz,kaliteli,almanya,turkiye,lokasyon,iletisim,r9,e5,mc,pre,minecraft,sunucu,hamachi,hediye,mc-tr";
                break;
            case "unturned":
                $sotitle="Unturned Sunucuları";
                $sodesc="Sunucularda kullanılan ssd diskimiz ile birlikte uygun fiyata çok hızlı ve kaliteli Ryzen 9 3900X veya E5-2690 v2 işlemciye sahip bir Unturned cihazına sahip olabilirsiniz.";
                $sokw="oyun,sunuculari,sunucucoplugu,kurumsal,webhosting,ucuz,kaliteli,almanya,turkiye,lokasyon,iletisim,r9,e5,mc,pre,minecraft,sunucu,hamachi,hediye,mc-tr,unturned,sunucu,vds,dedicated";
                break;
            case "fivem":
                $sotitle ="Fivem Sunucuları";
                $sodesc= "Sunucularda kullanılan ssd diskimiz ile birlikte uygun fiyata çok hızlı ve kaliteli Ryzen 9 3900X veya E5-2690 v2 işlemciye sahip bir Fivem cihazına sahip olabilirsiniz.";
                $sokw="oyun,sunuculari,sunucucoplugu,kurumsal,webhosting,ucuz,kaliteli,almanya,turkiye,lokasyon,iletisim,r9,e5,mc,pre,minecraft,sunucu,hamachi,hediye,mc-tr,unturned,sunucu,vds,dedicated,fivem,gtav";
                break;
            case "mcpe":
                $sotitle="MCPE Sunucular";
                $sodesc="Sunucularda kullanılan ssd diskimiz ile birlikte uygun fiyata çok hızlı ve kaliteli Ryzen 9 3900X veya E5-2690 v2 işlemciye sahip bir MCPE cihazına sahip olabilirsiniz.";
                $sokw="oyun,sunuculari,sunucucoplugu,kurumsal,webhosting,ucuz,kaliteli,almanya,turkiye,lokasyon,iletisim,r9,e5,mc,pre,minecraft,sunucu,hamachi,hediye,mc-tr,unturned,sunucu,vds,dedicated,mcpe,bedrock,minecraft";
                break;
        }
        break;
    case "blog":
            if(isset($action[1])){
                $lk = $db->prepare("SELECT * FROM blog WHERE id=?");
                $lk->execute(array($action[1]));
                    if($lk->rowCount() > 0){
                        $fetc = $lk->fetch(PDO::FETCH_ASSOC);
                        $sokw = $fetc["kw"];
                        $sotitle = $fetc["heading"];
                        $sodesc = "";
                        break;
                    }
                    
            } else {
                     $sotitle = "Tüm Bloglar";
                    $sodesc="Uygun fiyatlı kaliteli sunucular";
                    $sokw="oyun,sunuculari,sunucucoplugu,kurumsal,webhosting,ucuz,kaliteli,almanya,turkiye,lokasyon";
                    break;
            }
                    
            
            
    default:
        $sotitle = "Uygun fiyatlı kaliteli sunucular";
        $sodesc="Uygun fiyatlı kaliteli sunucular";
        $sokw="oyun,sunuculari,sunucucoplugu,kurumsal,webhosting,ucuz,kaliteli,almanya,turkiye,lokasyon";

        break;
}

function getcatbyid($type, $id){
    global $db;
    $get = $db->prepare("SELECT * FROM categories WHERE id=?");
    $get->execute(array($id));
    $fc = $get->fetch(PDO::FETCH_ASSOC);
    if(!isset($type)){
        return $fc["categoryname"];
    } else {
        switch ($type){
            case "color":
                return $fc["categorycolor"];
            default:
                return $fc["categoryname"];
        }
    }
}
function yuzdeHesaplama($sayi, $yuzde)
{
    $gecersiz = $sayi * $yuzde / 100;
    $gecerli =  $sayi - $gecersiz;
    $gecerli = str_replace( ".", ",", $gecerli);
    return $gecerli;
}

if(!file_exists($realPath."pages/".strtolower($action[0].".php"))){$action[0] = "404"; }
require $realPath."pages/".$action[0].".php";
?>