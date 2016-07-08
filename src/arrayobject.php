<?php

namespace Mysidia\Primitive\Native;
use ArrayIterator;

class ArrayObject extends Object{
    
    public static function chunk(array $self, int $length, bool $preserveKeys = FALSE){
        return  array_chunk($self, $length, $preserveKeys);
    }

    public static function clear(array $self){
        return [];
    }

    public static function collect(array $self, Callable $block){
        if(array_keys($self) !== range(0, count($self) - 1)) throw new UnsupportedOperationException("Associative arrays do not support method array::collect().");
        return array_map($block, $self);
    }

    public static function column(array $self, $columnKey, $indexKey = NULL){
        return array_column($self, $columnKey, $indexKey);
    }

    public static function compact(array $self){
        $array = [];
        if(array_keys($self) === range(0, count($self) - 1)){
            foreach($self as $value){
                if($value !== NULL) $array[] = $value;
            }
        }
        else{
            foreach($self as $key => $value){
                if($value !== NULL) $array[$value] = $value;
            }
        }    
        return $array;
    }

    public static function concat(array $self, array $other){
        return array_merge($self, $other);
    }

    public static function contains(array $self, $element){
        return in_array($element, $self);
    }

    public static function containsKey(array $self, string $key){
        return array_key_exists($key, $self);
    }

    public static function count(array $self, $element){
        $num = 0;
        if(array_keys($self) === range(0, count($self) - 1)){
            foreach($self as $value){
                if($value == $element) $num++;
            }
        }
        else{
            foreach($self as $key => $value){
                if($value == $element) $num++;
            }
        }    
        return $num;
    }

    public static function countUnique(array $self){
        return array_count_values($self);
    }

    public static function cycle(array $self, int $number = 2){
        if(array_keys($self) !== range(0, count($self) - 1)) throw new UnsupportedOperationException("Associative arrays do not support method array::cycle().");  
        $array = [];
        for($i = 0; $i < $number; $i++){
            $array = array_merge($array, $self);
        }  
        return $array;   
    }

    public static function delete(array $self, $element){
        $array = [];
        if(array_keys($self) === range(0, count($self) - 1)){
            foreach($self as $value){
                if($value != $element) $array[] = $value;
            }
        }
        else{
            foreach($self as $key => $value){
                if($value != $element) $array[$key] = $value;
            }
        }
        return $array;        
    }

    public static function deleteAt(array $self, int $index){
        return array_splice($self, $index, 1);
    }

    public static function diff(array $self, array $other, Callable $block = NULL){
        return $block ? array_udiff($self, $other) : array_diff($self, $other);
    }

    public static function diffKey(array $self, array $other, Callable $block = NULL){
        return $block ? array_diff_ukey($self, $other) : array_diff_key($self, $other);
    }

    public static function drop(array $self, $number){
        if(array_keys($self) !== range(0, count($self) - 1)) throw new UnsupportedOperationException("Associative arrays do not support method array::drop().");  
        $array = [];
        $count = count($self);
        for($i = $number; $i < $count; $i++){
            $array[] = $self[$i];
        }
        return $array;
    }

    public static function each(array $self, Callable $block){
        if(array_keys($self) === range(0, count($self) - 1)){
            foreach($self as $value){
                $block($value);
            }
        }
        else{
            foreach($self as $key => $value){
                $block($key, $value);
            }
        }
    }

    public static function eachIndex(array $self, Callable $block){
        if(array_keys($self) !== range(0, count($self) - 1)) throw new UnsupportedOperationException("Associative arrays do not support method array::eachIndex().");  
        $count = count($self);
        for($i = 0; $i < $count; $i++){
            $block($i);
        }
    }

    public static function eachKey(array $self, Callable $block){
        if(array_keys($self) === range(0, count($self) - 1)) throw new UnsupportedOperationException("Numeric arrays do not support method array::eachKey().");  
        foreach($self as $key => $value){
            $block($key);
        }
    }

    public static function fill(array $self, $element, int $index = 0, int $length = 1){
        if(array_keys($self) !== range(0, count($self) - 1)) throw new UnsupportedOperationException("Associative arrays do not support method array::fill().");  
        $array = $self;
        $count = ($index + $length < $count) ? $index + $length : $count;
        for($i = $index; $i < $count; $i++){
            $array[$i] = $element;
        }
        return $array;
    }

    public static function filter(array $self, Callable $block = NULL){
        return array_filter($self, $block);
    }

    public static function first(array $self, $number = 1){
        return array_slice($self, 0, $number); 
    }

    public static function flatten(array $self){
        if(array_keys($self) !== range(0, count($self) - 1)) throw new UnsupportedOperationException("Associative arrays do not support method array::flatten()."); 
        $array = [];
        array_walk_recursive($self, function($value) use (&$array) { 
            $array[] = $value; 
        });
        return $array;
    }

    public static function flip(array $self){
        return array_flip($self);
    }

    public static function hashCode(array $self){
        return hexdec(spl_object_hash(new \ArrayObject($self)));
    }

    public static function indexOf(array $self, $element){
        if(array_keys($self) !== range(0, count($self) - 1)) throw new UnsupportedOperationException("Associative arrays do not support method array::indexOf()."); 
        $index = array_search($element, $self);
        return ($index === FALSE) ? -1 : $index;
    }

    public static function insert(array $self, int $index, $element){
        if(array_keys($self) !== range(0, count($self) - 1)) throw new UnsupportedOperationException("Associative arrays do not support method array::insert()."); 
        return array_splice($self, $index, 0, [$element]);
    }

    public static function intersect(array $self, array $other, Callable $block = NULL){
        return $block ? array_uintersect($self, $other) : array_intersect($self, $other);
    }

    public static function intersectKey(array $self, array $other, Callable $block = NULL){
        return $block ? array_intersect_ukey($self, $other) : array_intersect_key($self, $other);
    }

	public static function isArray($self){
	    return TRUE;
	}      

    public static function isAssoc(array $self){
        return array_keys($self) !== range(0, count($self) - 1);
    }

    public static function isEmpty($self){
        return empty($self);
    }

    public static function isEnumerable($self){
        return TRUE;
    }

	public static function isFalse($self){
	    return empty($self);
	} 

	public static function isTrue($self){
	    return !empty($self);
	} 

    public static function iterator($self){
        return new ArrayIterator($self);
    }

    public static function join(array $self, string $delimiter = " "){
        return implode($delimiter, $self);
    }

    public static function keys(array $self){
        if(array_keys($self) === range(0, count($self) - 1)) throw new UnsupportedOperationException("Numeric arrays do not support method array::keys().");  
        return array_keys($self);
    }

    public static function last(array $self, $number = 1){
        return array_slice($self, -1, $number); 
    }

    public static function lastIndexOf(array $self, $element){
        $count = count($self);
        for($i = $count - 1; $i >= 0; $i--){
            if($self[$i] == $element) return $i;
        }
        return -1;
    }

    public static function length(array $self){
        return count($self);
    }

    public static function map(array $self, Callable $block){
        if(array_keys($self) !== range(0, count($self) - 1)) throw new UnsupportedOperationException("Associative arrays do not support method array::map().");
        return array_map($block, $self);        
    }

    public static function merge(array $self, array $other, bool $recursive = FALSE){
        return $recursive ? array_merge_recursive($self, $other) : array_merge($self, $other);
    }

    public static function pad(array $self, int $length, $element){
        return array_pad($self, $length, $element);
    }

    public static function pop(array $self, int $number = 1){
        if(array_keys($self) !== range(0, count($self) - 1)) throw new UnsupportedOperationException("Associative arrays do not support method array::pop().");
        $array = $self;
        for($i = 0; $i < $number; $i++){
            array_pop($array);
        }
        return $array;
    }

    public static function product(array $self){
        return array_product($self);
    }

    public static function push(array $self, $element){
        if(array_keys($self) !== range(0, count($self) - 1)) throw new UnsupportedOperationException("Associative arrays do not support method array::push().");
        $array = $self;
        array_push($array, $element);
        return $array;
    }    

    public static function rand(array $self, int $number){
        return array_rand($self, $number);
    }

    public static function reduce(array $self, Callable $block, $initial = NULL){
        return array_reduce($self, $block, $initial);
    }

    public static function reject(array $self, Callable $block){
        return array_filter($self, $block);
    }

    public static function replace(array $self, array $other, bool $recursive = FALSE){
        return $recursive ? array_replace_recursive($self, $other) : array_replace($self, $other);
    }

    public static function reverse(array $self, bool $preserveKeys = FALSE){
        return array_reverse($self, $preserveKeys);
    }

    public static function reverseEach(array $self, Callable $block){
        $array = array_reverse($self);
        return $array->each($block);
    }

    public static function rotate(array $self, int $number = 1){
        if(array_keys($self) !== range(0, count($self) - 1)) throw new UnsupportedOperationException("Associative arrays do not support method array::rotate().");
        $array = array_slice($self, $number);
        for($i = 0; $i < $number; $i++){
            $array[] = $self[$i];
        }        
        return $array;
    }

    public static function search(array $self, $element){
        return array_search($element, $self);
    }

    public static function select(array $self, Callable $block){
        $array = [];
        if(array_keys($self) === range(0, count($self) - 1)){
            foreach($self as $value){
                if($block($value)) $array[] = $value;
            }
        }
        else{
            foreach($self as $key => $value){
                if($block($key, $value)) $array[$key] = $value;
            }
        }
        return $array;        
    }

    public static function shift(array $self){
        $array = $self;
        array_shift($array);
        return $array;
    }
   
    public static function shuffle(array $self){
        $array = $self;
        shuffle($array);
        return $array;
    }

    public static function slice(array $self, int $index = 0, int $length = 1, bool $preserveKeys = FALSE){
        return array_slice($self, $index, $length, $preserveKeys);
    }

    public static function sort(array $self, Callable $block = NULL){
        $array = $self;
        if($block) usort($array, $block);
        else sort($array);
        return $array;
    }

    public static function sortKey(array $self, Callable $block = NULL){
        $array = $self;
        if($block) uksort($array, $block);
        else ksort($array);
        return $array;   
    }

    public static function sortValue(array $self, Callable $block = NULL){
        $array = $self;
        if($block) uasort($array, $block);
        else asort($array);
        return $array;   
    }
  
    public static function splice(array $self, int $index, int $length, $replacement = []){
        return array_splice($self, $index, $length, $replacement);
    }

    public static function sum(array $self){
        return array_sum($self);
    }

    public static function take(array $self, int $number){
        return array_slice($self, 0, $number);
    }

    public static function toArray($self){
        return $self;
    }

    public static function toLowerCase(array $self){
        return array_change_key_case(self, CASE_LOWER);
    }

    public static function toString($self){
        if(array_keys($self) === range(0, count($self) - 1)) return implode(", ", $self);
        $string = "";
        foreach($self as $key => $value){
            $string .= "{$key}: {$value}, ";
        }
        return $string;
    }    

    public static function toUpperCase(array $self){
        return array_change_key_case(self, CASE_UPPER);
    }

    public static function unique(array $self){
        return array_unique($self);
    }

    public static function unshift(array $self, $element){
        $array = $self;
        array_unshift($array, $element);
        return $array;
    }

    public static function values(array $self){
        return array_values($self);
    }

    public static function walk(array $self, Callable $block, bool $recursive = FALSE){
        $array = $self;
        if($recursive) array_walk_recursive($array, $block);
        else array_walk($array, $block);
        return $array;
    }
}