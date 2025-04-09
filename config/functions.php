<?php

    use PhpOffice\PhpWord\Element\Text;
    use PhpOffice\PhpWord\Element\TextRun;
    use Mpdf\Mpdf;

    function simplify_filename($filename) {
    // Split the filename into parts by dots
    $parts = explode('.', $filename);

    // If there's only one part, there's no extension to simplify
    if (count($parts) < 2) {
        return $filename;
    }

    // Take the first part (base name) and the last part (extension)
    $basename = array_shift($parts);
    $extension = array_pop($parts);

    // Reassemble the filename with only one extension
    return $basename . '.' . $extension;
}

    function Redirect($path) {
        header("location: $path");
    }

    function ImageLink($str){
		$str = str_replace(array('!','"','','ﾃつ｣','$','%','%','^','&','*','(','+','=','¥¥','/','[',']','{','}',';',':','@','#','‾','<',',','.','?','|',),' ',$str);
                $str = str_replace(' ','-',$str);
                $str = str_replace('_','-',$str);
                $str = str_replace('---','-',$str);
                $str = str_replace('--','-',$str);
                $str = str_replace(')','',$str);
		return $str;
	}
	
	function getMetaCode($path)
    {
      global $rootpath;
      return file_get_contents($rootpath . '/Template/widget/' . $path . '.html');
    }
    
    	function getAds($path)
    {
      global $rootpath;
      return file_get_contents($rootpath . '/Template/ads/' . $path . '.html');
    }

    

    function slug($str)
{
    if (extension_loaded('intl')) {
        $generator = new Ausi\SlugGenerator\SlugGenerator();
        return $generator->generate($str);
      }
        $str = str_replace(' ', '-', trim($str));
        $str = str_replace('_', '-', $str);
        $str = preg_replace("/[^A-Za-z0-9-]/", "", $str);
        $str = str_replace('---', '-', $str);
        $str = str_replace('--', '-', $str);
        return strtolower($str);
}


function extractText($element) {
    $text = '';
    if ($element instanceof Text) {
        $text .= $element->getText() . "\n";
    } elseif ($element instanceof TextRun) {
        foreach ($element->getElements() as $childElement) {
            $text .= extractText($childElement);
        }
    }
    return $text;
}



function Renamess($str)
{
    $str = str_replace(' ', '_', trim($str));
    $str = preg_replace("/[^A-Za-z0-9-_]/", "", $str);
    $str = str_replace('___', '_', $str);
    $str = str_replace('__', '_', $str);
    return $str;
}

function InputArray($str)
{
    if (isset($_REQUEST[$str])) {
        $val = $_REQUEST[$str];
        if (is_array($val)) {
            $sanVal = [];
            foreach ($val as $key => $value) {
                $sanVal[$key] = filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
            return $sanVal;
        }
        return filter_var($val, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    return [];
}


function dtOrderby($var = true)
{
    if ($var == true)
        return $_POST['order']['0']['column'];
    else
        return  $_POST['order']['0']['dir'];
}
function dtlimit($var = true)
{
    if ($var == true)
        return $_POST['start'];
    else
        return  $_POST['length'];
}

function getPart($url, $key) {
    $part = explode('/', $url);

    return isset( $part[$key] ) ? $part[$key] : null;
}
function Input($value) {
    $val =  "";

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $val =  filter_input(INPUT_POST, $value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    } elseif($_SERVER['REQUEST_METHOD'] === 'GET') {
        $val =  filter_input(INPUT_GET, $value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    
    return $val;    
}

function removeQ($str) {
    $val = strtok($str, '?');
    return $val;
}

function formatSize($size, $type = false, $round = 2)
{
  $sizes = array('BYTES', 'KB', 'MB', 'GB', 'TB');
  $total = count($sizes) - 1;
  for ($i = 0; $size > 1024 && $i < $total; $i++)
    $size /= 1024;
  if ($type == true)
    return array(round($size, $round), $sizes[$i]);
  return round($size, $round) . ' ' . $sizes[$i];
}

    function view($paths, $data = []) {
        extract($data); 
        if (is_array($paths)) {
            foreach ($paths as $path) {
                require_once $path;
            }
        } elseif (is_string($paths)) {
            require_once $paths;
        }
    }

    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        return $ipaddress;
    }

    function removeExtension($file) {
        $FileTo = pathinfo($file);
        
        return $FileTo['filename'];
    }

    function checkFileExist($folder, $name, $ext) {
            $filen = $folder . '/' . $name;
            $file = $name.'.'.$ext;
            while (file_exists($filen)) {
                $new = removeExtension($filen) . '-' . rand(0, 999).'.'.$ext;
                $file = basename($new).'.'.$ext;
            }
        
            return $file;
    }

    function upload ($data) {
        if(!empty($data['file_url'])) {

            $ct = file_get_contents($data['file_url']);

            if($ct) {

                $date = date('Y/m/');
                $dir = PUBLICPATH.'/files/'.$date;
                if(!is_dir($dir)) {
                    mkdir($dir, 0777, true);
                }
                $name = Renamess($data['name']);
                
                 $ext = getExt($data);
                 $file = checkFileExist($dir, $name, $ext);
                 $upload_dir = $dir. $file;

                 if(file_put_contents($upload_dir, $ct)) {
                    return $file;
                 } else {
                    return false;
                 }

            } else {
                return false;
            }



        } else if(!empty($data['file_name'])) {

            $date = date('Y/m/');
            $dir = PUBLICPATH.'/files/'.$date;
            if(!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
            $name = Renamess($data['name']);
            $ext = pathinfo($data['file_name'], PATHINFO_EXTENSION);
            $file = checkFileExist($dir, $name, $ext);
            $upload_dir = $dir. $file;

            if(move_uploaded_file($data['file_tmp'], $upload_dir)) {
                return $file;
            } else {
                return false;
            }
        

        }
    }

    

    function getAdmin($url) {
        $startPos = strpos($url, '/SHU-Admin/');

        if ($startPos !== false) {
            
            $substring = substr($url, $startPos, strlen('/SHU-Admin'));
            return true; 
        } else {
            return false;
        }
    }

    function checkType($data) {
        if (!empty($data['file_url'])) {
            $fileUrl = $data['file_url'];
            $AllowedExt = array('txt', 'pdf', 'docx', 'doc');
            $pathInfo = pathinfo($fileUrl);
            $ext = strtolower($pathInfo['extension'] ?? '');

            if (!in_array($ext, $AllowedExt)) {
        
                return true;
            }
        } else {
            $allowedExt = array('txt', 'pdf', 'docx', 'doc');
            $ext = pathinfo($data['file_name'], PATHINFO_EXTENSION);
    
            if (!in_array($ext, $allowedExt)) {
        
                return true;
            }
        }
    }

    function fsize($path) { 
        $fp = fopen($path,"r"); 
        $inf = stream_get_meta_data($fp); 
        fclose($fp); 
        foreach($inf["wrapper_data"] as $v) { 
          if (stristr($v, "content-length")) { 
            $v = explode(":", $v); 
            return trim($v[1]); 
          } 
        } 
        return 0;
      } 

    function getSize($data) {
        if (!empty($data['file_url'])) {
            $url = $data['file_url'];
            return fsize($url);
        } else {
            $size = $data['file_size'];
             return $size;
        }
    }

    function embedPdfInIframe($pdfPath) {

        $html = '<div class="pdf-container mt-5">';
        $html = '<div class="device-frame" id="device-frame">';
        $html .= '<iframe id="pdf-iframe" src="' . $pdfPath . '" class="pdf-iframe"></iframe>';
        $html .= '</div>';
        $html .= '<button id="fullscreen-btn" class="fullscreen-btn">Full Screen</button>';
        $html .= '</div>';
        return $html;
    }

    function checkSize($data) {
        if (!empty($data['file_url'])) {
            $url = $data['file_url'];
            
                $size = fsize($url);
    
                if ($size >= 20000000) {
                    return true;
                }
            


        } else {
            $size = $data['file_size'];
                if ($size >= 20000000) {
                    return true;
         }
        }
    }

    function getExt($data) {
        if(!empty($data['file_url'])) {
            $pathinfo = pathinfo($data['file_url']);
            return strtolower($pathinfo['extension'] ?? '');
        } else  {
            return pathinfo($data['file_name'], PATHINFO_EXTENSION);
        }
    }

    function checkImageType($data) {
        if (!empty($data['img_url'])) {
            $imageUrl = $data['img_url'];
            $AllowedExt = array('png', 'jpg', 'jpeg', 'webp', 'gif');
            $pathInfo = pathinfo($imageUrl);
            $ext = strtolower($pathInfo['extension'] ?? '');

            if (!in_array($ext, $AllowedExt)) {
        
                return true;
            }
        } else {
            $allowedExt = array('jpg', 'jpeg', 'png', 'gif', 'webp');
            $ext = pathinfo($data['img_name'], PATHINFO_EXTENSION);
    
            if (!in_array($ext, $allowedExt)) {
        
                return true;
            }
        }
    }
    
    function checkImageSize($data) {
        if (!empty($data['img_url'])) {
            $imageUrl = $data['img_url'];
            
            $size = fsize($imageUrl);

                if ($size >= 6000000) {
                    return true;
                }

        } else {
            $size = $data['img_size'];
                if ($size >= 6000000) {
                    return true;
         }
        }
    }

    function checkExists($folder, $name) {
        $file = PUBLICPATH . '/thumb/' . $folder . '/' . $name;
    
        while (file_exists($file)) {
            $file = removeExtension($file) . '-' . rand(0, 999) . '.webp';
        }
    
        return basename($file);
    }

    function resizeImage($resourceType, $iw, $ih, $resizeWidth = 1000, $resizeHeight = 1000) {

        $imageLayer = imagecreatetruecolor($resizeWidth, $resizeHeight);
        imagecopyresampled($imageLayer, $resourceType, 0, 0, 0, 0, $resizeWidth, $resizeHeight, $iw, $ih);
        return $imageLayer;
    }

    function logoUpload($logo, $logoname) {
        if($logo) {
            $fileName = $logo;
            $name = "logo";
            $sourceProperties = getimagesize($fileName);
            $uploadPath = PUBLICPATH.'/img/';
            $fileExt = pathinfo($logoname, PATHINFO_EXTENSION);
            $targetdir = $uploadPath;
    
            if (!is_dir($targetdir)) {
                mkdir($targetdir, 0777, true);
            }

            if(file_exists($targetdir.'/'.$name.'.'.$fileExt)) {
                unlink($targetdir.'/'.$name.'.'.$fileExt);
            }
            

            $resizeFileName = $name.'.'.$fileExt;
            $url = APP_URL.'/Public/img/'.$resizeFileName;

            $uploadPath = $targetdir;
            $uploadImageType = $sourceProperties[2];
            $sourceImageWidth = $sourceProperties[0];
            $sourceImageHeight = $sourceProperties[1];
    
            switch ($uploadImageType) {
                case IMAGETYPE_JPEG:
                    $resourceType = imagecreatefromjpeg($fileName);
                    break;
    
                case IMAGETYPE_GIF:
                    $resourceType = imagecreatefromgif($fileName);
                    break;
    
                case IMAGETYPE_PNG:
                    $resourceType = imagecreatefrompng($fileName);
                    break;
    
                case IMAGETYPE_WEBP:
                    $resourceType = imagecreatefromwebp($fileName);
                    break;
    
                default:
                
                    return false;
            }
    
            
                $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, 280, 75);
            
    
            switch ($uploadImageType) {
                case IMAGETYPE_JPEG:
                    $success = imagejpeg($imageLayer, $uploadPath . $resizeFileName );
                    break;
    
                case IMAGETYPE_GIF:
                    $success = imagegif($imageLayer, $uploadPath . $resizeFileName);
                    break;
    
                case IMAGETYPE_PNG:
                    $success = imagepng($imageLayer, $uploadPath . $resizeFileName);
                    break;
    
                case IMAGETYPE_WEBP:
                    $success = imagewebp($imageLayer, $uploadPath . $resizeFileName);
                    break;
    
                default:
                    $success = false;
                    break;
            }
    
            imagedestroy($resourceType);
            imagedestroy($imageLayer);

            if($success !== false) {
                return $url;
            } else {
                return false;
            }
        }
    }


    function renderCommentsBlog($comments, $isLogin, $AuthUser, $id) {
        $html = '';
        
    
        foreach ($comments as $comment) {
            $email = $isLogin ? '<input type="hidden" name="email" value="' . $AuthUser['email'] . '">' : '<input type="email" class="form-control" name="email" placeholder="Your Email">';

            $name = $isLogin ? '<input type="hidden" name="name" value="' . $AuthUser['name'] . '">' : '<input type="text" class="form-control" name="name" placeholder="Your Name">';

            $html .= '<div class="comment-box mb-32">';
            $html .= '<img src="'.APP_URL.'/Public/assets/main/img/author.jpg" alt="" style="width:64px;height:64px;">';
            $html .= '<div class="block">';
            $html .= '<div class="top-row mb-16">';
            $html .= '<div class="info">';
            $html .= '<h6 class="dark-gray mb-8">' . date('d, F Y', strtotime($comment['created_at'])) . '</h6>';
            $html .= '<h5>' . $comment['name'] . '</h5>';
            $html .= '</div>';
            $html .= '<button class="accordion-button comment-btn reply-btn b-unstyle mx-5" data-bs-toggle="collapse" data-bs-target="#reply' . $comment['id'] . '" aria-expanded="true">Reply</button>';
            $html .= '</div>';
            $html .= '<p class="dark-gray mb-24">' . htmlspecialchars($comment['content']) . '</p>';
            $html .= '<div id="reply' . $comment['id'] . '" class="accordion-collapse collapse write-reply" data-bs-parent="#accordionExample">';
            $html .= '<div class="write-comment-box">';
            $html .= '<form class="auth">';
            $html .= '<div class="input-group">';
            $html .=  $email;
            $html .=  $name;
            $html .= '</div>';
            $html .= '<div class="input-group">';
            $html .= '<input type="text" class="form-control" name="content" required placeholder="Write your comment">';
            $html .= '<input type="hidden" name="post_id" value="' . $id . '">';
            $html .= '<input type="hidden" name="parent_id" value="' . $comment['id'] . '">';
            $html .= '<input type="hidden" name="action" value="addblogreply">';
            $html .= '<button type="submit" class="b-unstyle color-primary">Post</button>';
            $html .= '</div>';
            $html .= '</form>';
            $html .= '</div>';
            $html .= '</div>';
    
            // Recursively render replies
            if (!empty($comment['replies'])) {
                $html .= '<div class="replies">';
                $html .= renderCommentsBlog($comment['replies'], $isLogin, $AuthUser, $id);
                $html .= '</div>';
            }
    
            $html .= '</div>';
            $html .= '</div>';
        }
    
        return $html;
    }

    function renderComments($comments, $isLogin, $AuthUser, $file) {
        $html = '';
        
    
        foreach ($comments as $comment) {
            $html .= '<div class="comment-box mb-32">';
            $html .= '<img src="/Public/thumb/users/' . $comment['user_image'] . '" alt="" style="width:64px;height:64px;">';
            $html .= '<div class="block">';
            $html .= '<div class="top-row mb-16">';
            $html .= '<div class="info">';
            $html .= '<h6 class="dark-gray mb-8">' . date('d, F Y', strtotime($comment['created_at'])) . '</h6>';
            $html .= '<h5>' . $comment['user_name'] . '</h5>';
            $html .= '</div>';
            $html .= '<button class="accordion-button comment-btn reply-btn b-unstyle mx-5" data-bs-toggle="collapse" data-bs-target="#reply' . $comment['id'] . '" aria-expanded="true">Reply</button>';
            $html .= '</div>';
            $html .= '<p class="dark-gray mb-24">' . htmlspecialchars($comment['content']) . '</p>';
            $html .= '<div id="reply' . $comment['id'] . '" class="accordion-collapse collapse write-reply" data-bs-parent="#accordionExample">';
            $html .= '<div class="write-comment-box">';
            $html .= '<form class="auth">';
            $html .= '<div class="input-group">';
            $html .= '<input type="text" class="form-control" name="content" required placeholder="Write your comment">';
            $html .= '<input type="hidden" name="user_id" value="' . ($isLogin ? $AuthUser['id'] : '') . '">';
            $html .= '<input type="hidden" name="file_id" value="' . $file['id'] . '">';
            $html .= '<input type="hidden" name="parent_id" value="' . $comment['id'] . '">';
            $html .= '<input type="hidden" name="action" value="addreply">';
            $html .= '<button type="submit" class="b-unstyle color-primary">Post</button>';
            $html .= '</div>';
            $html .= '</form>';
            $html .= '</div>';
            $html .= '</div>';
    
            // Recursively render replies
            if (!empty($comment['replies'])) {
                $html .= '<div class="replies">';
                $html .= renderComments($comment['replies'], $isLogin, $AuthUser, $file);
                $html .= '</div>';
            }
    
            $html .= '</div>';
            $html .= '</div>';
        }
    
        return $html;
    }
    
    function uploadImage($data, $folder) {
        if (!empty($data['img_url'])) {
            
            $imageUrl = $data['img_url'];
            $imageData = file_get_contents($imageUrl);
    
            if ($imageData === false) {
                
                return false;
            }

    
            
            $uploadPath = PUBLICPATH.'/thumb/'. $folder . '/';
            $fileExt = 'webp';
            $targetdir = $uploadPath;
            
            $date = date('Y/m/');
            $targetdir .= $date;
            if (!is_dir($targetdir)) {
                mkdir($targetdir, 0777, true);
            }
            $name = 'thumb-'.rand(1000, 9999).rand(1000, 9999).rand(1000, 9999);
            $newName = checkExists($folder.'/'.$date, $name);

            $resizeFileName = $newName.'.'.$fileExt;

            $uploadPath = $targetdir;
    
            $sourceProperties = getimagesizefromstring($imageData);
            $uploadImageType = $sourceProperties[2];
            $sourceImageWidth = $sourceProperties[0];
            $sourceImageHeight = $sourceProperties[1];
    
            switch ($uploadImageType) {
                case IMAGETYPE_JPEG:
                    $resourceType = imagecreatefromstring($imageData); // Incorrect, should be imagecreatefromjpeg
                    break;
    
                case IMAGETYPE_GIF:
                    $resourceType = imagecreatefromstring($imageData); // Incorrect, should be imagecreatefromgif
                    break;
    
                case IMAGETYPE_PNG:
                    $resourceType = imagecreatefromstring($imageData); // Incorrect, should be imagecreatefrompng
                    break;
    
                case IMAGETYPE_WEBP:
                    $resourceType = imagecreatefromstring($imageData); // Incorrect, should be imagecreatefromwebp
                    break;
    
                default:
                    // Handle unsupported image types or set $imageProcess = 0;
                    return false;
            }
    
            
            
            $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight);
            
            switch ($uploadImageType) {
                case IMAGETYPE_JPEG:
                    $success = imagejpeg($imageLayer, $uploadPath . $resizeFileName);
                    break;
    
                case IMAGETYPE_GIF:
                    $success = imagegif($imageLayer, $uploadPath . $resizeFileName);
                    break;
    
                case IMAGETYPE_PNG:
                    $success = imagepng($imageLayer, $uploadPath . $resizeFileName);
                    break;
    
                case IMAGETYPE_WEBP:
                    $success = imagewebp($imageLayer, $uploadPath . $resizeFileName );
                    break;
    
                default:
                    $success = false;
                    break;
            }
    
            imagedestroy($resourceType);
            imagedestroy($imageLayer);
    
            if ($success !== false) {
                return $resizeFileName;
            } else {
                return false; 
            }
        } else {
            $fileName = $data['img_tmp'];
            $sourceProperties = getimagesize($fileName);
            $uploadPath = PUBLICPATH.'/thumb/'. $folder . '/';
            $fileExt = 'webp';
            $targetdir = $uploadPath;
            
            $date = date('Y/m/');
            $targetdir .= $date;
            if (!is_dir($targetdir)) {
                mkdir($targetdir, 0777, true);
            }
            $name = 'thumb-'.rand(1000, 9999).rand(1000, 9999).rand(1000, 9999);
            $newName = checkExists($folder.'/'.$date, $name);

            $resizeFileName = $newName.'.'.$fileExt;

            $uploadPath = $targetdir;
            $uploadImageType = $sourceProperties[2];
            $sourceImageWidth = $sourceProperties[0];
            $sourceImageHeight = $sourceProperties[1];
    
            switch ($uploadImageType) {
                case IMAGETYPE_JPEG:
                    $resourceType = imagecreatefromjpeg($fileName);
                    break;
    
                case IMAGETYPE_GIF:
                    $resourceType = imagecreatefromgif($fileName);
                    break;
    
                case IMAGETYPE_PNG:
                    $resourceType = imagecreatefrompng($fileName);
                    break;
    
                case IMAGETYPE_WEBP:
                    $resourceType = imagecreatefromwebp($fileName);
                    break;
    
                default:
                
                    return false;
            }
    
            
                $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight);
            
    
            switch ($uploadImageType) {
                case IMAGETYPE_JPEG:
                    $success = imagejpeg($imageLayer, $uploadPath . $resizeFileName );
                    break;
    
                case IMAGETYPE_GIF:
                    $success = imagegif($imageLayer, $uploadPath . $resizeFileName);
                    break;
    
                case IMAGETYPE_PNG:
                    $success = imagepng($imageLayer, $uploadPath . $resizeFileName);
                    break;
    
                case IMAGETYPE_WEBP:
                    $success = imagewebp($imageLayer, $uploadPath . $resizeFileName);
                    break;
    
                default:
                    // Handle unsupported image types if needed
                    $success = false;
                    break;
            }
    
            imagedestroy($resourceType);
            imagedestroy($imageLayer);

            if($success !== false) {
                return $resizeFileName;
            } else {
                return false;
            }
        }
    }

  

    function movieTR($resourceType, $iw, $ih, $cw, $ch) {
        
        $imageLayer = imagecreatetruecolor($cw, $ch);
        imagecopyresampled($imageLayer, $resourceType, 0, 0, 0, 0, $cw, $ch, $iw, $ih);
        return $imageLayer;
    }

    function uploadThumb($data, $folder) {

        if(!empty($data['img_url']) || !empty($data['img_name'])) {
            $name = 'thumb-' . rand(1000, 9999) . rand(1000, 9999) . rand(1000, 9999);
            $date = date('/Y/m/');
            $newName = checkExists("182x268/".$folder.$date, $name);
            $fileExt = 'webp';
            $resizeFileName = $newName . '.' . $fileExt;
            $success = true;
            $m = ""; 
        
            // Define an array of image sizes
            $imageSizes = [
                ['width' => 182, 'height' => 268],
                ['width' => 225, 'height' => 325],
                ['width' => 450, 'height' => 650],
            ];
        
            foreach ($imageSizes as $size) {
                $width = $size['width'];
                $height = $size['height'];
        
                // Prepare the upload path
                $uploadPath = PUBLICPATH . '/thumb/' . $width . 'x' . $height . '/' . $folder . '/';
                $date = date('Y/m/');
                $targetdir = $uploadPath . $date;
        
                if (!is_dir($targetdir)) {
                    mkdir($targetdir, 0777, true);
                }
        
                $uploadPath = $targetdir;
        
                // Process the image
                if (!empty($data['img_url'])) {
                    $imageUrl = $data['img_url'];
                    $imageData = file_get_contents($imageUrl);
        
                    if ($imageData === false) {
                        $success = false;
                        $m = "Error 1";
                        break;
                    }
        
                    $sourceProperties = getimagesizefromstring($imageData);
                    $uploadImageType = $sourceProperties[2];
                    $sw = $sourceProperties[0];
                    $sh = $sourceProperties[1];
        
                    switch ($uploadImageType) {
                        case IMAGETYPE_JPEG:
                            $resourceType = imagecreatefromstring($imageData); // Incorrect, should be imagecreatefromjpeg
                            break;
            
                        case IMAGETYPE_GIF:
                            $resourceType = imagecreatefromstring($imageData); // Incorrect, should be imagecreatefromgif
                            break;
            
                        case IMAGETYPE_PNG:
                            $resourceType = imagecreatefromstring($imageData); // Incorrect, should be imagecreatefrompng
                            break;
            
                        case IMAGETYPE_WEBP:
                            $resourceType = imagecreatefromstring($imageData); // Incorrect, should be imagecreatefromwebp
                            break;
            
                        default:
                            // Handle unsupported image types or set $imageProcess = 0;
                            return false;
                    }
    
                } else if(!empty($data['img_name'])) {
                    $fileName = $data['img_tmp'];
                    $sourceProperties = getimagesize($fileName);
        
                    $uploadImageType = $sourceProperties[2];
                    $sw = $sourceProperties[0];
                    $sh = $sourceProperties[1];
        
                    switch ($uploadImageType) {
                        case IMAGETYPE_JPEG:
                            $resourceType = imagecreatefromjpeg($fileName);
                            break;
        
                        case IMAGETYPE_GIF:
                            $resourceType = imagecreatefromgif($fileName);
                            break;
        
                        case IMAGETYPE_PNG:
                            $resourceType = imagecreatefrompng($fileName);
                            break;
        
                        case IMAGETYPE_WEBP:
                            $resourceType = imagecreatefromwebp($fileName);
                            break;
        
                        default:
                            $success = false;
                            $m = "Error 2";
                            break;
                    }
                }
        
                if ($success) {
                    $imageLayer = movieTR($resourceType, $sw, $sh, $width, $height);
        
                    switch ($uploadImageType) {
                        case IMAGETYPE_JPEG:
                            $success = imagejpeg($imageLayer, $uploadPath . $resizeFileName );
                            break;
            
                        case IMAGETYPE_GIF:
                            $success = imagegif($imageLayer, $uploadPath . $resizeFileName);
                            break;
            
                        case IMAGETYPE_PNG:
                            $success = imagepng($imageLayer, $uploadPath . $resizeFileName);
                            break;
            
                        case IMAGETYPE_WEBP:
                            $success = imagewebp($imageLayer, $uploadPath . $resizeFileName);
                            break;
        
                        default:
                            $success = false;
                            $m = "Error 3";
                            break;
                    }
        
                    imagedestroy($resourceType);
                    imagedestroy($imageLayer);
        
                    if (!$success) {
                        break;
                        $m = "Error 4";
                    }
                }
            }
        
            if ($success) {
                return $resizeFileName;
            } else {
                return false;
            }
        }
   
    }


    function WriteToFile($Path, $string, $overwrite = true)
    {
        if (file_exists($Path) && !$overwrite) {
            return false;  // File exists and we are not allowed to overwrite
        }
    
        $myfile = fopen($Path, "w");
    
        if ($myfile === false) {
            error_log("Unable to open file! Write Permission ");
            return false;  // Return false to indicate failure
        }
    
        fwrite($myfile, $string);
        fclose($myfile);
        return true;
    }
    

    function to_time_ago( $time ) {
      
        $diff = time() - $time;
          
        if( $diff < 1 ) { 
            return 'less than 1 second ago'; 
        }
          
        $time_rules = array ( 
                    12 * 30 * 24 * 60 * 60 => 'year',
                    30 * 24 * 60 * 60       => 'month',
                    24 * 60 * 60           => 'day',
                    60 * 60                   => 'hour',
                    60                       => 'minute',
                    1                       => 'second'
        );
      
        foreach( $time_rules as $secs => $str ) {
              
            $div = $diff / $secs;
      
            if( $div >= 1 ) {
                  
                $t = round( $div );
                  
                return $t . ' ' . $str . 
                    ( $t > 1 ? 's' : '' ) . ' ago';
            }
        }
    }



    function fileDownload($Path, $fileName, $ext)
{
  switch ($ext) {
    case 'TXT':
      $mime = "text/plain";
      break;
    case 'PDF':
      $mime = "application/pdf";
      break;
    case 'DOC':
      $mime = "application/msword";
      break;
    case 'DOCX':
      $mime = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
      break;
    case 'JPG':
      $mime = "image/jpg";
      break;
    default:
      $mime = "application/octet-stream";
  }

  header('Content-type: ' . $mime);
  header('Content-Disposition: attachment; filename="' . $fileName . '"');
  header('Content-Length: ' . filesize($Path));
  readfile($Path);
  exit;
}
    
    
    

    
    






    
    

