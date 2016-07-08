<?php

namespace Mysidia\Primitive;

class NullObject extends Object{
    
    public static function compareTo($self, $other){
        return ($self == $other) ? 0 : ($self ? 1 : -1);
    }

    public static function hashCode($self){
        return 0;
    }

	public static function isEmpty($self){
	    return TRUE;
	}     

    public static function isFalse($self){
        return TRUE;
    }

	public static function isNull($self){
	    return TRUE;
	}

    public static function isTrue($self){
        return FALSE;
    }
}