<?php

namespace AtysQobuz\Entity ;

use AtysQobuz\Atys ;



class Album
{
    public function __construct($input)
    {
    	if (is_string($input)) : 
    		$input = json_decode($input, true);
    	endif;

    	foreach ($input as $key => $value) :
    		$this->{$key} = $value ;
    	endforeach;
    }

    public function getArticles()
    {
        return $this->articles;
    }

    public function getArtist()
    {
        return $this->artist;
    }

    public function getAwards()
    {
        return $this->awards;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getGenre()
    {
        return $this->genre;
    }

    public function getGoodies()
    {
        return $this->goodies;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getPurchasable()
    {
        return $this->purchasable;
    }

    public function getReleasedAt()
    {
        return $this->released_at;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getTracks()
    {
        return $this->tracks;
    }

    public function getUrl()
    {
        return $this->url;
    }
}