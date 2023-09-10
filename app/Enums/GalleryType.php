<?php

namespace App\Enums;

enum GalleryType: string {
    case PHOTO = 'photo';
    case VIDEO = 'video';

    public function label(): string
    {
        return match ($this) {
            self::PHOTO => 'Photo',
            self::VIDEO => 'Vidéo',
        };
    }
    
    public function color(): string
    {
        return match ($this) {
            self::PHOTO => 'text-dark btn btn-primary',
            self::VIDEO => 'text-dark btn btn-warning',
        };
    }

    public static function getRandomMediaTypeName()
    {
        $arr = array();
        $arrDT = GalleryType::cases();

        for ($i = 0; $i < GalleryType::count(); $i++) {
            $arr[$i] = $arrDT[$i]->value;
        }

        $nbrAl = array_rand($arr, 1);

        return $arrDT[$nbrAl]->value;
    }

    private static function count(): int
    {
        return count(GalleryType::cases());
    }

}
