<?php

namespace Mysidia\Primitive;

class FloatObject extends NumberObject{
    
    public static function getExp(float $self){
        return (int)log10(abs($self));
    }

    public static function isFinite(float $self){
        return is_finite($self);
    }

    public static function isInfinite(float $self){
        return is_infinite($self);
    }

    public static function isNan(float $self){
        return is_nan($self);
    } 

    public static function truncate($self){
        return (int)$self;
    } 
}