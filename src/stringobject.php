<?php

namespace Mysidia\Primitive\Native;
use DateTime;

class StringObject extends Object{
    
    public static function addSlashes(string $self){
        return addslashes($self);
    }

    public static function capitalize(string $self){
        return ucfirst($self);
    }

    public static function capitalizeWords(string $self, string $delimiter = " \t\r\n\f\v"){
        return ucwords($self, $delimiter);
    }

    public static function charAt(string $self, int $index){
        if($index > strlen($self)) throw new IllegalArgumentException("Index out of bound for string method charAt.");
        return substr($self, $index, 1);
    }

    public static function compareTo(string $self, $other){
        return strcmp(self, (string)$other);        
    }

    public static function compareToIgnoreCase(string $self, $other){
        return strncasecmp($self, (string)$other);
    }

    public static function concat(string $self, $other){
        return $self . (string)$other;
    }

    public static function contains(string $self, string $substr){
        return strpos($self, $substr) !== FALSE;
    }

    public static function containsAll(string $self, array $substrs){
        foreach($substrs as $substr){
            if(strpos($self, $substr) === FALSE) return FALSE;
        }
        return TRUE;
    }

    public static function containsAny(string $self, array $substrs){
        foreach($substrs as $substr){
            if(strpos($self, $substr) !== FALSE) return TRUE;
        }
        return FALSE;
    }

    public static function decapitalize(string $self){
        return lcfirst($self);
    }   

    public static function endsWith(string $self, string $substr){
        return ($self->lastIndexOf($substr) === strlen($self) - strlen($substr));
    }

    public static function equals($self, $other){
        return strcmp(self, (string)$other) === 0;
    }

    public static function equalsIgnoreCase(string $self, $other){
        return strncasecmp($self, (string)$other) === 0;
    }

    public static function getEncoding(string $self){
        return mb_detect_encoding($self);
    }

    public static function hashCode(string $self){
        $hash = 0;
        $length = strlen($self);
        for($i = 0; $i < $length; $i++){       
            $value = (int)(31 * $hash + ord($self[$i])) & 0xffffffff;
            $value = $value % 4294967296;
            if($value > 2147483647) $hash = $value - 4294967296;
            elseif ($value < -2147483648) $hash = $value + 4294967296;
            else $hash = $value;
        }
        return $hash;
    }

    public static function indexOf(string $self, string $substr, int $offset = 0){
        if($offset > strlen($self)) throw new IllegalArgumentException("Offset out of bound string method indexOf.");
        $pos = strpos($self, $substr, $offset);    
        return ($pos === FALSE)?-1:$pos;   
    }

    public static function insert(string $self, int $offset, $other){
        if($offset > strlen($self)) throw new IllegalArgumentException("Offset out of bound for string method insert.");
        return $self->splice($offset, 0, (string)$other);
    }

    public static function isBlank(string $self){
        return ($self->trim() === "");
    }

	public static function isDate($self){
	    try{
            $date = new DateTime($self); 
            return TRUE;
        }
        catch(IllegalArgumentException $iae){
            return FALSE;
        }
	}

    public static function isEmpty($self){
        return ($self === "");
    } 

    public static function isLowerCase(string $self){
        return ($self === strtolower($self));
    }

    public static function isNotBlank(string $self){
        return ($self->trim() !== "");
    }

    public static function isNotEmpty(string $self){
        return ($self !== "");
    } 

    public static function isPalindrome(string $self){
        return ($self === $self->reverse());
    }

    public static function isString($self){
        return TRUE;
    }

    public static function isUnicase(string $self){
        return ($self === strtoupper($self) || $self === strtolower($self));
    }

    public static function isUpperCase(string $self){
        return ($self === strtoupper($self));
    }

    public static function isZero(string $self){
        return ($self == "0");
    }

    public static function lastIndexOf(string $self, string $substr, int $offset = 0){
        if($offset > strlen($self)) throw new IllegalArgumentException("Offset out of bound for string method lastIndexOf.");
        $pos = strrpos($self, $substr, $offset);    
        return ($pos === FALSE)?-1:$pos;   
    }

    public static function left(string $self, string $length){
        if($length > strlen($self)) throw new IllegalArgumentException("Length out of bound for string method left.");
        return substr($self, 0, $length);
    }

    public static function length(string $self){
        return strlen($self);
    }

    public static function matches(string $self, $pattern){
        return preg_match((string)$pattern, $self);
    }

    public static function naturalCompareTo(string $self, $other){
        return strnatcmp($self, (string)$other);
    }

    public static function naturalCompareToIgnoreCase(string $self, $other){
        return strnatcasecmp($self, (string)$other);
    }

    public static function ord(string $self){
        return ord($self);
    }

    public static function pad(string $self, int $length, $padding = NULL){
        if(!$padding) $padding = " ";
        return str_pad($self, $length, (string)$padding, STR_PAD_BOTH);
    }

    public static function padEnd(string $self, int $length, $padding = NULL){
        if(!$padding) $padding = " ";
        return str_pad($self, $length, (string)$padding, STR_PAD_RIGHT);
    }

    public static function padStart(string $self, int $length, $padding = NULL){
        if(!$padding) $padding = " ";
        return str_pad($self, $length, (string)$padding, STR_PAD_LEFT);
    }

    public function remove(string $self, string $substr){
        return $self->replace($substr);
    }

    public static function removeAll(string $self, array $search){
        return $self->replaceAll($search);
    }    

    public static function removeDuplicates(string $self, string $substr){
        $pattern = '/(' . preg_quote($substr, '/') . ')+/';
        return $self->replaceRegex($pattern, $substr);
    }

    public static function removeOnce(string $self, string $substr){
        return $self->removeRegex($substr, 1);
    }

    public static function removeRegex(string $self, string $pattern, int $limit = -1){
        $self->replaceRegex($pattern, "", $limit);
    }

    public static function removeSpaces(string $self){
        $self->removeAll([" ", "\r", "\n", "\t", "\0", "\x0B"]);
    }

    public static function repeat(string $self, int $multiplier = 2){
        return str_repeat($self, $multiplier);
    }

    public static function replace(string $self, string $search, string $replace = ""){
        return str_replace($search, $replace, $self);
    }

    public static function replaceAll(string $self, array $search, array $replace = []){
        if(!$replace) $replace = array_fill(0, count($search), "");
        return str_replace($search, $replace, $self);
    }  

    public static function replaceOnce(string $self, string $search, string $replace){
     	return $self->replaceRegex($search, $replace, 1);
    }

    public static function replaceOnceAll(string $self, array $search, array $replace){
        return $self->replaceRegexAll($search, $replace, 1);
    }   

    public static function replaceRegex(string $self, string $search, string $replace, int $limit = -1){
        return preg_replace($search, $replace, $self, $limit);
    } 

    public static function replaceRegexAll(string $self, array $search, array $replace, int $limit = -1){
        if(!$replace) $replace = array_fill(0, count($search), "");
        return preg_replace($search, $replace, $self, $limit);
    }

    public static function reverse(string $self){
        return strrev($self);
    }

    public static function right(string $self, int $length){
        if($length > strlen($self)) throw new IllegalArgumentException("Length out of bound for string method right.");
        return substr($self, $length * -1);
    }

    public static function shuffle(string $self){
        return str_shuffle($self);
    }

    public static function splice(string $self, int $offset, int $length = NULL, $replacement = NULL){
        $count = strlen($self);
        if($offset > $count) throw new IllegalArgumentException("Length out of bound for string method splice.");
        if($offset < 0) $offset += $count;
        if(!$length) $length = $count;
        elseif($length < 0) $lengh += $count - $offset;
        return substr($self, 0, $offset) . (string)$replacement . substr($self, $offset + $length);
    }

    public static function split(string $self, string $delimiter = "", int $limit = PHP_INT_MAX){
        return explode($delimiter, $self, $limit);
    }

    public static function squeeze(string $self){
        return $self->replace([" ", "\r", "\n", "\t", "\0", "\x0B"], " ")->removeDuplicates(" ")->trim();
    }    

    public static function startsWith(string $self, string $substr){
        return strpos($self, $substr) === 0;
    }

    public static function stripSlashes(string $self){
        return stripslashes($self);
    }

    public static function substring(string $self, int $start, int $length = NULL){
        if($length > strlen($self)) throw new IllegalArgumentException("Length out of bound for string method insert.");
        return substr($self, $start, $length);
    }

    public static function substringAfterFirst(string $self, string $separator, bool $inclusive = FALSE){
        $string = strstr($self, $separator);
        if($string === FALSE) return NULL;
        if($inclusive) return $string;
        return $string->substring(1);      
    }

    public static function substringAfterLast(string $self, string $separator, bool $inclusive = FALSE){
        $string = strrchr($self, $separator);
        if($string === FALSE) return NULL;
        if($inclusive) return $string;
        return $string->substring(1);
    }

    public static function substringBeforeFirst(string $self, string $separator, bool $inclusive = FALSE){   
        $string = strstr($self, $separator, TRUE);
        if($string === FALSE) return NULL;
        if($inclusive) return $string . $separator;
        return $string;
    }

    public static function substringBeforeLast(string $self, string $separator, bool $inclusive = FALSE){
        $index = $self->lastIndexOf($separator);
        if(!$index) return NULL;
        if($inclusive) $index++;
        return $self->substring(0, $index);
    }

    public static function substringBetween(string $self, string $left = NULL, string $right = NULL){
        if(!$left && !$right) return NULL;
        if(!$left) $left = $right;
		if(!$right) $right = $left;        
        $indexLeft  = $self->indexOf($left);
        if(!$indexLeft) return NULL;
        $indexLeft += strlen($left);      
        $indexRight = $self->indexOf($right, $indexLeft - 1);
        if(!$indexRight) return NULL;
        return $self->substring($indexLeft, $indexRight - $indexLeft);
    }

    public static function substringCount(string $self, string $substr){
        return substr_count($self, $substr);
    }

    public static function substringReplace(string $self, int $start, int $length = NULL, string $replacement = ""){
        return substr_replace($self, $replacement, $start, $length);
    }

    public static function substringSplit(string $self, int $length){
        return str_split($self, $length);
    }   

    public static function swapCase(string $self){
        $string = "";
        $count = strlen($self);
        for($i = 0; $i < $count; $i++) {
            $char = $self[$i];
            if($char->isLowerCase()) $string .= strtoupper($char);
			else $string .= strtolower($char);
        }
        return $string;
    } 

    public static function toArray($self){
        return str_split($self);
    }    

    public static function toCharArray(string $self){
        $count = strlen($self);
        $chars = [];
        for($i = 0; $i < $count; $i++){
            $chars[$i] = $self[$i];
        }
        return $chars;
	}

     public static function toJson(string $self){
        return json_encode($self);
     }

    public static function toLowerCase(string $self){
        return strtolower($self);
    }

    public static function toUpperCase(string $self){
        return strtoupper($self);
    }

    public static function trim(string $self, string $charMask = NULL){
        return trim($self, $charMask);
    }

    public static function trimEnd(string $self, string $charMask = NULL){
        return rtrim($self, $charMask);
    }

    public static function trimStart(string $self, string $charMask = NULL){
        return ltrim($self, $charMask);
    }
}