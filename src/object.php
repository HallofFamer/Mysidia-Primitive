<?php

namespace Mysidia\Primitive\Native;

abstract class Object{
    
    public static function equals($self, $other){
        return $self == $other;
    }

    public static function getClass($self){
        return gettype($self);
    }

	public static function isArray($self){
	    return FALSE;
	}   

	public static function isCallable($self){
	    return FALSE;
	}   

	public static function isDate($self){
	    return FALSE;
	}      

	public static function isEmpty($self){
	    return FALSE;
	} 

	public static function isEnumerable($self){
	    return FALSE;
	}     

 	public static function isFalse($self){
	    return FALSE;
	} 

	public static function isNull($self){
	    return FALSE;
    }     

	public static function isNumeric($self){
	    return FALSE;
	}

	public static function isString($self){
	    return FALSE;
	}    

	public static function isTrue($self){
	    return TRUE;
	}   

    public static function toArray($self){
        return [$self];
    }

    public static function serialize($self){
        return serialize($self);
    }

    public static function unserialize($self, $other){
        return unserialize($other);
    }
}