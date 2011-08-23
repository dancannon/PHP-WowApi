<?php
namespace WowApi;

class Utilities
{
    protected static $normalizedChars = array(
        'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
        'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
        'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
        'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
        'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
        'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
        'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f'
    );

    /**
     * @static
     * @param $region Region
     * @param $thumbnail Thumbnail path from API
     * @return string
     */
    public static function getThumbnailUrl($region, $thumbnail)
    {
        return sprintf('http://%1$s.battle.net/static-render/%1$s/%2$s', $region, $thumbnail);
    }

    /**
     * @static
     * @throws \InvalidArgumentException
     * @param $region Region
     * @param $icon Icon path from API
     * @param string $size Icon size (Allowed sizes: 18, 36, 56)
     * @return string
     */
    public static function getIconURL($region, $icon, $size = '36')
    {
        if(!in_array($size, array(18, 36, 56))) {
            throw new \InvalidArgumentException("That size is not allowed.");
        }
        return sprintf('http://%s.media.blizzard.com/wow/icons/%d/%s.jpg', $region, $size, $icon);
    }

    public static function urlencode($input)
    {
        if(is_array($input)) {
            return array_map(array('\WowApi\Utilities', 'urlencode'), $input);
        } elseif (is_scalar($input)) {
            return rawurlencode($input);
        } else {
            return '';
        }
    }

    public static function build_http_query($params) {
        if (!$params) {
            return '';
        }

        // Urlencode both keys and values
        $keys   = self::urlencode(array_keys($params));
        $values = self::urlencode(array_values($params));
        $params = array_combine($keys, $values);

        // Parameters are sorted by name, using lexicographical byte value ordering.
        uksort($params, 'strcmp');

        $pairs = array();
        foreach ($params as $parameter => $value) {
            if (is_array($value)) {
                $pairs[] = $parameter . '=' . implode(',', $value);
            } else {
                $pairs[] = $parameter . '=' . $value;
            }
        }
        // For each parameter, the name is separated from the corresponding value by an '=' character (ASCII code 61)
        // Each name-value pair is separated by an '&' character (ASCII code 38)
        return '?' . implode('&', $pairs);
    }

    public static function getGenderName($gender) {
        switch ($gender) {
            case 0:
                return 'Male';
            break;
            case 1:
                return 'Female';
            break;
            default:
                return false;
            break;
        }
    }
}
