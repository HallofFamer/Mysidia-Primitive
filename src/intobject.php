<?php

namespace Mysidia\Primitive\Native;

class IntObject extends NumberObject{

    public static function chr(int $self){
        return chr($self);
    }

    public static function downto(int $self, int $limit, Callable $block){
        if($self < $limit) throw new IllegalArgumentException("Limit cannot be greater than the integer value for downto method.");
        for($i = $self; $i >= $limit; $i--){
            $block($i);
        }
    }

    public static function gcd(int $self, int $other){
        $num = $self;
        $num2 = $other;
        while($num2 != 0){
            $temp = $num % $num2;
            $num = $num2;
            $num2 = $temp;
        }
        return abs($num);
    }

    public static function gcdlcm(int $self, int $other){
        return [$self->gcd($other), $self->lcm($other)];
    }   

    public static function isEven(int $self){
        return $self % 2 == 0;
    }

    public static function isOdd(int $self){
        return $self % 2 != 0;
    }

    public static function lcm(int $self, int $other){
        return $self * ($other / $self->gcd($other)); 
    }

    public static function leftShift(int $self, int $other){
        return $self >> $other;
    }     

    public static function next(int $self){
        return $self + 1;
    }

    public static function rightShift(int $self, int $other){
        return $self << $other;
    } 

    public static function pred(int $self){
        return $self - 1;
    }

    public static function succ(int $self){
        return $self + 1;
    }

	public static function times(int $self, Callable $block){
        $limit = abs($self);
	    for($i = 0; $i < $limit; $i++){
            $block($i);
        }
	}

	public static function toBinary(int $self){
        return decbin($self);	
    } 

	public static function toHex(int $self){
	    return dechex($self);
	}  

	public static function toOctal(int $self){
        return decoct($self);	
	}

      public static function upto(int $self, int $limit, Callable $block){
        if($self > $limit) throw new IllegalArgumentException("Limit cannot be greater than the integer value for downto method.");
        for($i = $self; $i <= $limit; $i++){
            $block($i);
        }
    }
}