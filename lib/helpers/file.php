<?php

class File
{
  public static function getNextFilename($dir, $filename)
  {
    if (file_exists($dir . $filename)) {
      $fileNameData = explode(".", $filename);
      // $fileNameData = [0 => photo, 1 => jpg]

      if (count($fileNameData) == 2) {

        for ($i = 1; $i < 100; $i++) {
          $newFileName = $fileNameData[0] . "_" . $i . "." . $fileNameData[1];
          $fullFilenamePath = $dir . $newFileName;

          if (!file_exists($fullFilenamePath)) {
            return $newFileName;
          }
        }
      }
    }

    return $filename;
  }
}
