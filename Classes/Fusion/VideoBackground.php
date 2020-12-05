<?php
namespace NeosRulez\Bootstrap\Fusion;

use Neos\Flow\Annotations as Flow;
use Neos\Fusion\FusionObjects\AbstractFusionObject;

class VideoBackground extends AbstractFusionObject {

    /**
     * @return string
     */
    public function evaluate() {

        $link = $this->fusionValue('videourl');

        if($link) {

            if (strpos($link, 'embed') !== false) {
                $linkString = explode('/', $link);
                $youtubeId = array_pop($linkString);
                $link = 'https://www.youtube.com/embed/'.$youtubeId.'?controls=0&showinfo=0&rel=0&autoplay=1&mute=1&loop=1&playlist='.$youtubeId;
            }

            if (strpos($link, 'watch') !== false) {
                $youtubeId = substr($link, strpos($link, "=") + 1);
                $link = 'https://www.youtube.com/embed/'.$youtubeId.'?controls=0&showinfo=0&rel=0&autoplay=1&mute=1&loop=1&playlist='.$youtubeId;
            }

            if (strpos($link, 'youtu.be') !== false) {
                $youtube_id = str_replace('https://youtu.be/', '', $link);
                $link = 'https://www.youtube.com/embed/'.$youtube_id.'?controls=0&showinfo=0&rel=0&autoplay=1&mute=1&loop=1&playlist='.$youtubeId;
            }

            if (strpos($link, 'player') !== false) {
                if(preg_match("/\/(\d+)$/",$link,$matches)) {
                    $vimeoId = $matches[1];
                }
                $link = 'https://player.vimeo.com/video/'.$vimeoId.'?autoplay=1&loop=1&title=0&portrait=0&byline=0';
            }

            if (strpos($link, 'vimeo') !== false) {
                $linkString = explode('/', $link);
                $vimeoId = array_pop($linkString);
                $link = 'https://player.vimeo.com/video/'.$vimeoId.'?autoplay=1&loop=1&title=0&portrait=0&byline=0';
            }

        }

        return $link;

    }
}