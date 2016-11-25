<?php

    ini_set('post_max_size', CONFIG['imageSettings']['uploadSize']);
    ini_set('upload_max_filesize', CONFIG['imageSettings']['uploadSize']);

    class FeedbackModel extends Model {

        private static $rid;

        function __construct(){}


        public function getData(){
            $data = array();
            $link = DB::Connect();
            $q = DB::Query($link, 'SELECT * FROM reviews WHERE access = 1 ORDER BY reviews.time DESC');

            while ($row = $q->fetch_assoc()) {
                $data[] = $row;
            }
            DB::Disconnect($link);
            return $data;
        }

        public function handleFeedback($data){
            if($data['sub'])
                $datav = $this->validData($data);
                if($datav){
                    self::$rid = UniqID::generate();
                    if($this->addData($data)){
                        self::imageHandler();
                        header('Location: /feedback?s=1');
                    }
                    // echo '<div class="info_block success">Успешно!<br /> </div>';
                }
                else {
                    // header('Location: /feedback?s=0');
                    // echo '<div class="info_block error">Извините, ваши данные не валидны!</div>';
                }
        }
        private static function imageHandler(){
            $file = $_FILES['file'];
            if(file_exists($file['tmp_name'])) {
                if(self::isAccessImage($file)) { # если это не тот файл, который нам нужен,- нет смысла его проверять
                    if(self::isImage($file)){
                        $img = self::resizeImage($file['tmp_name']);
                        imagejpeg($img, ROOT.CONFIG['imageSettings']['pathStorage'].self::$rid.'.jpg'); // тут я оставил так, чтобы был единый формат
                        // header('Location: /feedback?s=1');
                    } else {}
                } else {}
            }

        }
        private static function isAccessImage($file){
            $whiteList = CONFIG['imageSettings']['accessImages'];
            $ext = explode('.', $file['name']);
            $ext = strtoupper(end($ext));

            return in_array($ext, $whiteList);
        }

        private static function isImage($file){
            $imagedata = getimagesize($file['tmp_name']);
            if($imagedata) return 1;
            else return 0;
        }

        private static function resizeImage($file, $crop=FALSE){

            $w = CONFIG['imageSettings']['width'];
            $h = CONFIG['imageSettings']['height'];

            list($width, $height) = getimagesize($file);
            $r = $width / $height;
            if ($crop) {
                if ($width > $height) {
                    $width = ceil($width-($width*abs($r-$w/$h)));
                } else {
                    $height = ceil($height-($height*abs($r-$w/$h)));
                }
                $newwidth = $w;
                $newheight = $h;
            } else {
                if ($w/$h > $r) {
                    $newwidth = $h*$r;
                    $newheight = $h;
                } else {
                    $newheight = $w/$r;
                    $newwidth = $w;
                }
            }
            $src = imagecreatefromjpeg($file);
            $dst = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

            return $dst;
        }

        private function validData($data){
            $flag = 1;

            $patterns = array(
                'name'  => ' /^[a-zа-я0-9_-]{3,16}$/iu',
                'email' => '/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/',
                'txt'   => '/.*/u'
            );

            foreach ($patterns as $key => $value) {
                if(!preg_match($patterns[$key], $data[$key])) $flag = 0;
            }

            // if($flag)
            //     $data['txt'] = ($data['txt']);

            return $flag;
        }

        private function addData($data){
            $link = DB::Connect();
            if(!$link) return false;

            DB::Query($link,
                "INSERT INTO reviews(rid, name, email, txt, access)
                    VALUES(
                        ".self::$rid.",
                        '".mysqli_real_escape_string($link, $data['name'])."',
                        '".mysqli_real_escape_string($link, $data['email'])."',
                        '".mysqli_real_escape_string($link, $data['txt'])."',
                        '".CheckUser::isAccess()."'
                    )"
            );
            DB::Disconnect($link);
            return 1;
        }


    }

?>
