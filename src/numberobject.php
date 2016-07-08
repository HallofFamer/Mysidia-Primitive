<?php

namespace Mysidia\Primitive;

abstract class NumberObject extends Object{
    
    public static function abs($self){
        return abs($self);
    }

    public static function abs2($self){
	    return pow($self, 2);
	} 

    public static function ceil($self){
        return (int)(ceil($self));
    }

    public static function coerce($self, $other){
        return [$other, $self];
    }

    public static function compareTo($self, $other){
        if(!is_numeric($other)) throw new IllegalArgumentException("Supplied argument must be a numeric value!");  
        return $self - $other;      
    }

    public static function divide($self, $other){
        if($self == 0) throw new IllegalArgumentException("Cannot divide by Zero!");
        return $self / $other;
    }

    public static function divMod($self, $other){
        $div = [];
        $div[0] = floor($self / $other);
        $div[1] = $self - $div[0] * $other;
        return $div;
    } 

    public static function divQuo($self, $other){
        return floor($self / $other);
    } 

    public static function equals($self, $other){
        return ($self == $other);
    } 
 
    public static function floatValue($self){
        return (float)$self;
    } 

    public static function floor($self){
        return (int)(floor($self));
    }

    public static function half($self){
        return $self / 2;
    } 

    public static function intValue($self){
        return (int)$self;
    }

 	public static function isEmpty($self){
	    return $self == 0;
	}   

 	public static function isFalse($self){
	    return $self == 0;
	}      

	public static function isNegative($self){
	    return $self < 0;
	}     

	public static function isNumeric($self){
	    return TRUE;
	}       

   	public static function isPositive($self){
	    return $self > 0;
	} 

    public static function isTrue($self){
        return $self != 0;
    }

    public static function isZero($self){
        return $self == 0;
    }

    public static function magnitude($self){
        return abs($self);
    }

    public static function quotiant($self, $other){
        return $self->divQuo($other);
    }

    public static function round($self, $precision = NULL){
        return round($self, $precision);        
    }

	public static function step($self, $limit, $step, Callable $block){
        $i = abs($self);
        while($i <= $limit){
            $block($i);
            $i += $step;
        }
	}

    public static function toBool($self){
        return (bool)$self;
    }

    public static function toFloat($self){
        return (float)$self;
    }

    public static function toInt($self){
        return (int)$self;
    }

    public static function truncate($self){
        return $self;
    }     

    public static function twice($self){
        return $self * 2;
    }
}