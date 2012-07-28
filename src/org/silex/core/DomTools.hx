package org.silex.core;

import js.Lib;
import js.Dom;

/**
 * Helper to manipulate the dom
 */
class DomTools {
	/**
	 * add a css class to a node if it is not already in the class name
	 */
	static public function addClass(element:HtmlDom, className:String) {
		if(element.className.indexOf(className) == -1)
			element.className += " "+ className;
	}
	/**
	 * remove a css class from a node 
	 */
	static public function removeClass(element:HtmlDom, className:String) {
		if(element.className.indexOf(className) > -1)
			element.className = StringTools.replace(element.className, className, "");
	}
}
