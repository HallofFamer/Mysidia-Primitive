<?php

namespace Mysidia\Primitive\Native;

class BoolObject extends Object{
    
    public static function compareTo(bool $self, $other){
        return ($self == $other) ? 0 : ($self ? 1 : -1);
    }

    public static function hashCode(bool $self){
        return self ? 1231: 1237;
    }

    public static function ifFalse(bool $self, Callable $block){
        if(!$self) $block();
        return $self;
    }

    public static function ifTrue(bool $self, Callable $block){
        if($self) $block();
        return $self;
    }

	public static function isEmpty($self){
	    return $self == FALSE;
	}     

    public static function isFalse($self){
        return $self == FALSE;
    }

    public static function isTrue($self){
        return $self == TRUE;
    }
}