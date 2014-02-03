<?php
namespace WowApi\Api;

use WowApi\Utilities;

class Guild extends AbstractProfileApi
{
    protected $fieldsWhitelist = array('members', 'achievements', 'news', 'challenge');

    public function getGuild($realm, $guild, $fields = array())
    {
        $this->setFields($fields);

        $guild = $this->get($this->generatePath('guild/:realm/:guild', array(
            'realm' => $realm,
            'guild' => $guild,
        )));

        return $guild;
    }

    /**
     * Returns an image resource containing the emblem
     *
     * Thanks to wowarmoryapi
     * @see http://sourceforge.net/p/wowarmoryapi/
     *
     * @param array $guildData The guild data returned by the getGuild function
     * @param bool $showlevel Whether to show the guild level
     * @param bool $emblemShowRing Whether to show the ring
     * @param int $width The width of the image
     * @return resource
     */
    public function createEmblem($guildData, $showlevel=false, $emblemShowRing=false, $width=215){

        if ($width > 1 && $width < 215){
            $height = ($width/215)*230;
            $finalimg = imagecreatetruecolor($width, $height);
            $trans_colour = imagecolorallocatealpha($finalimg, 0, 0, 0, 127);
            imagefill($finalimg, 0, 0, $trans_colour);
            imagesavealpha($finalimg,true);
            imagealphablending($finalimg, true);
        }

        if ($guildData['side'] == 0){
            $ring = 'alliance';
        } else {
            $ring = 'horde';
        }

        $imgOut = imagecreatetruecolor(215, 230);

        $emblemURL = dirname(__FILE__)."/../../../img/emblems/emblem_".sprintf("%02s",$guildData['emblem']['icon']).".png";
        $borderURL = dirname(__FILE__)."/../../../img/borders/border_".sprintf("%02s",$guildData['emblem']['border']).".png";
        $ringURL = dirname(__FILE__)."/../../../img/static/ring-".$ring.".png";
        $shadowURL = dirname(__FILE__)."/../../../img/static/shadow_00.png";
        $bgURL = dirname(__FILE__)."/../../../img/static/bg_00.png";
        $overlayURL = dirname(__FILE__)."/../../../img/static/overlay_00.png";
        $hooksURL = dirname(__FILE__)."/../../../img/static/hooks.png";
        $levelURL = dirname(__FILE__)."/../../../img/static/";

        imagesavealpha($imgOut,true);
        imagealphablending($imgOut, true);
        $trans_colour = imagecolorallocatealpha($imgOut, 0, 0, 0, 127);
        imagefill($imgOut, 0, 0, $trans_colour);

        $ring = imagecreatefrompng($ringURL);
        $ring_size = getimagesize($ringURL);

        $emblem = imagecreatefrompng($emblemURL);
        $emblem_size = getimagesize($emblemURL);
        imagelayereffect($emblem, IMG_EFFECT_OVERLAY);
        $emblemcolor = preg_replace('/^ff/i','',$guildData['emblem']['iconColor']);
        $color_r = hexdec(substr($emblemcolor,0,2));
        $color_g = hexdec(substr($emblemcolor,2,2));
        $color_b = hexdec(substr($emblemcolor,4,2));
        imagefilledrectangle($emblem,0,0,$emblem_size[0],$emblem_size[1],imagecolorallocatealpha($emblem, $color_r, $color_g, $color_b,0));


        $border = imagecreatefrompng($borderURL);
        $border_size = getimagesize($borderURL);
        imagelayereffect($border, IMG_EFFECT_OVERLAY);
        $bordercolor = preg_replace('/^ff/i','',$guildData['emblem']['borderColor']);
        $color_r = hexdec(substr($bordercolor,0,2));
        $color_g = hexdec(substr($bordercolor,2,2));
        $color_b = hexdec(substr($bordercolor,4,2));
        imagefilledrectangle($border,0,0,$border_size[0]+100,$border_size[0]+100,imagecolorallocatealpha($border, $color_r, $color_g, $color_b,0));

        $shadow = imagecreatefrompng($shadowURL);

        $bg = imagecreatefrompng($bgURL);
        $bg_size = getimagesize($bgURL);
        imagelayereffect($bg, IMG_EFFECT_OVERLAY);
        $bgcolor = preg_replace('/^ff/i','',$guildData['emblem']['backgroundColor']);
        $color_r = hexdec(substr($bgcolor,0,2));
        $color_g = hexdec(substr($bgcolor,2,2));
        $color_b = hexdec(substr($bgcolor,4,2));
        imagefilledrectangle($bg,0,0,$bg_size[0]+100,$bg_size[0]+100,imagecolorallocatealpha($bg, $color_r, $color_g, $color_b,0));


        $overlay = imagecreatefrompng($overlayURL);
        $hooks = imagecreatefrompng($hooksURL);

        $x = 20;
        $y = 23;

        if ($emblemShowRing){
            imagecopy($imgOut,$ring,0,0,0,0, $ring_size[0],$ring_size[1]);
        }
        $size = getimagesize($shadowURL);
        imagecopy($imgOut,$shadow,$x,$y,0,0, $size[0],$size[1]);
        imagecopy($imgOut,$bg,$x,$y,0,0, $bg_size[0],$bg_size[1]);
        imagecopy($imgOut,$emblem,$x+17,$y+30,0,0, $emblem_size[0],$emblem_size[1]);
        imagecopy($imgOut,$border,$x+13,$y+15,0,0, $border_size[0],$border_size[1]);
        $size = getimagesize($overlayURL);
        imagecopy($imgOut,$overlay,$x,$y+2,0,0, $size[0],$size[1]);
        $size = getimagesize($hooksURL);
        imagecopy($imgOut,$hooks,$x-2,$y,0,0, $size[0],$size[1]);

        if ($showlevel){
            $level = $guildData['level'];
            if ($level < 10){
                $levelIMG = imagecreatefrompng($levelURL.$level.".png");
            } else {
                $digit[1] = substr($level,0,1);
                $digit[2] = substr($level,1,1);
                $digit1 = imagecreatefrompng($levelURL.$digit[1].".png");
                $digit2 = imagecreatefrompng($levelURL.$digit[2].".png");
                $digitwidth = imagesx($digit1);
                $digitheight = imagesy($digit1);
                $levelIMG = imagecreatetruecolor($digitwidth*2,$digitheight);
                $trans_colour = imagecolorallocatealpha($levelIMG, 0, 0, 0, 127);
                imagefill($levelIMG, 0, 0, $trans_colour);
                imagesavealpha($levelIMG,true);
                imagealphablending($levelIMG, true);
                // Last image added first because of the shadow need to be behind first digit
                imagecopy($levelIMG,$digit2,$digitwidth-12,0,0,0, $digitwidth, $digitheight);
                imagecopy($levelIMG,$digit1,12,0,0,0, $digitwidth, $digitheight);
            }
            $size[0] = imagesx($levelIMG);
            $size[1] = imagesy($levelIMG);
            $levelemblem = imagecreatefrompng($ringURL);
            imagesavealpha($levelemblem,true);
            imagealphablending($levelemblem, true);
            imagecopy($levelemblem,$levelIMG,(215/2)-($size[0]/2),(215/2)-($size[1]/2),0,0,$size[0],$size[1]);
            imagecopyresampled($imgOut, $levelemblem, 143, 150,0,0, 215/3, 215/3, 215, 215);
        }

        if ($width > 1 && $width < 215){
            imagecopyresampled($finalimg, $imgOut, 0, 0, 0, 0, $width, $height, 215, 230);
        } else {
            $finalimg = $imgOut;
        }

        return $finalimg;
    }
}
