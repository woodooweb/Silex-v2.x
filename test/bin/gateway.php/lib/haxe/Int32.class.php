<?php

class haxe_Int32 {
	public function __construct(){}
	static function make($a, $b) {
		$GLOBALS['%s']->push("haxe.Int32::make");
		$�spos = $GLOBALS['%s']->length;
		{
			$�tmp = $a << 16 | $b;
			$GLOBALS['%s']->pop();
			return $�tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function ofInt($x) {
		$GLOBALS['%s']->push("haxe.Int32::ofInt");
		$�spos = $GLOBALS['%s']->length;
		{
			$�tmp = $x | 0;
			$GLOBALS['%s']->pop();
			return $�tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function clamp($x) {
		$GLOBALS['%s']->push("haxe.Int32::clamp");
		$�spos = $GLOBALS['%s']->length;
		{
			$�tmp = $x | 0;
			$GLOBALS['%s']->pop();
			return $�tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function toInt($x) {
		$GLOBALS['%s']->push("haxe.Int32::toInt");
		$�spos = $GLOBALS['%s']->length;
		if(($x >> 30 & 1) !== _hx_shift_right($x, 31)) {
			throw new HException("Overflow " . Std::string($x));
		}
		{
			$�tmp = $x & -1;
			$GLOBALS['%s']->pop();
			return $�tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function toNativeInt($x) {
		$GLOBALS['%s']->push("haxe.Int32::toNativeInt");
		$�spos = $GLOBALS['%s']->length;
		{
			$�tmp = $x;
			$GLOBALS['%s']->pop();
			return $�tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function add($a, $b) {
		$GLOBALS['%s']->push("haxe.Int32::add");
		$�spos = $GLOBALS['%s']->length;
		{
			$�tmp = $a + $b | 0;
			$GLOBALS['%s']->pop();
			return $�tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function sub($a, $b) {
		$GLOBALS['%s']->push("haxe.Int32::sub");
		$�spos = $GLOBALS['%s']->length;
		{
			$�tmp = $a - $b | 0;
			$GLOBALS['%s']->pop();
			return $�tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function mul($a, $b) {
		$GLOBALS['%s']->push("haxe.Int32::mul");
		$�spos = $GLOBALS['%s']->length;
		{
			$�tmp = $a * ($b & 65535) + ($a * (_hx_shift_right($b, 16)) << 16 | 0) | 0;
			$GLOBALS['%s']->pop();
			return $�tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function div($a, $b) {
		$GLOBALS['%s']->push("haxe.Int32::div");
		$�spos = $GLOBALS['%s']->length;
		{
			$�tmp = intval($a / $b);
			$GLOBALS['%s']->pop();
			return $�tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function mod($a, $b) {
		$GLOBALS['%s']->push("haxe.Int32::mod");
		$�spos = $GLOBALS['%s']->length;
		{
			$�tmp = _hx_mod($a, $b);
			$GLOBALS['%s']->pop();
			return $�tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function shl($a, $b) {
		$GLOBALS['%s']->push("haxe.Int32::shl");
		$�spos = $GLOBALS['%s']->length;
		{
			$�tmp = $a << $b;
			$GLOBALS['%s']->pop();
			return $�tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function shr($a, $b) {
		$GLOBALS['%s']->push("haxe.Int32::shr");
		$�spos = $GLOBALS['%s']->length;
		{
			$�tmp = $a >> $b;
			$GLOBALS['%s']->pop();
			return $�tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function ushr($a, $b) {
		$GLOBALS['%s']->push("haxe.Int32::ushr");
		$�spos = $GLOBALS['%s']->length;
		{
			$�tmp = _hx_shift_right($a, $b);
			$GLOBALS['%s']->pop();
			return $�tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function hand($a, $b) {
		$GLOBALS['%s']->push("haxe.Int32::and");
		$�spos = $GLOBALS['%s']->length;
		{
			$�tmp = $a & $b;
			$GLOBALS['%s']->pop();
			return $�tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function hor($a, $b) {
		$GLOBALS['%s']->push("haxe.Int32::or");
		$�spos = $GLOBALS['%s']->length;
		{
			$�tmp = $a | $b;
			$GLOBALS['%s']->pop();
			return $�tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function hxor($a, $b) {
		$GLOBALS['%s']->push("haxe.Int32::xor");
		$�spos = $GLOBALS['%s']->length;
		{
			$�tmp = $a ^ $b;
			$GLOBALS['%s']->pop();
			return $�tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function neg($a) {
		$GLOBALS['%s']->push("haxe.Int32::neg");
		$�spos = $GLOBALS['%s']->length;
		{
			$�tmp = -$a;
			$GLOBALS['%s']->pop();
			return $�tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function isNeg($a) {
		$GLOBALS['%s']->push("haxe.Int32::isNeg");
		$�spos = $GLOBALS['%s']->length;
		{
			$�tmp = $a < 0;
			$GLOBALS['%s']->pop();
			return $�tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function isZero($a) {
		$GLOBALS['%s']->push("haxe.Int32::isZero");
		$�spos = $GLOBALS['%s']->length;
		{
			$�tmp = $a === 0;
			$GLOBALS['%s']->pop();
			return $�tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function complement($a) {
		$GLOBALS['%s']->push("haxe.Int32::complement");
		$�spos = $GLOBALS['%s']->length;
		{
			$�tmp = ~$a;
			$GLOBALS['%s']->pop();
			return $�tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function compare($a, $b) {
		$GLOBALS['%s']->push("haxe.Int32::compare");
		$�spos = $GLOBALS['%s']->length;
		{
			$�tmp = $a - $b;
			$GLOBALS['%s']->pop();
			return $�tmp;
		}
		$GLOBALS['%s']->pop();
	}
	static function ucompare($a, $b) {
		$GLOBALS['%s']->push("haxe.Int32::ucompare");
		$�spos = $GLOBALS['%s']->length;
		if($a < 0) {
			$�tmp = haxe_Int32_0($a, $b);
			$GLOBALS['%s']->pop();
			return $�tmp;
		}
		{
			$�tmp = haxe_Int32_1($a, $b);
			$GLOBALS['%s']->pop();
			return $�tmp;
		}
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'haxe.Int32'; }
}
function haxe_Int32_0(&$a, &$b) {
	$�spos = $GLOBALS['%s']->length;
	if($b < 0) {
		return ~$b - ~$a;
	} else {
		return 1;
	}
}
function haxe_Int32_1(&$a, &$b) {
	$�spos = $GLOBALS['%s']->length;
	if($b < 0) {
		return -1;
	} else {
		return $a - $b;
	}
}