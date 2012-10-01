<?php

class cocktail_core_renderer_InvalidatingElementRenderer extends cocktail_core_renderer_ElementRenderer {
	public function __construct($domNode) {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("cocktail.core.renderer.InvalidatingElementRenderer::new");
		$製pos = $GLOBALS['%s']->length;
		parent::__construct($domNode);
		$this->_needsLayout = true;
		$this->_childrenNeedLayout = true;
		$this->_positionedChildrenNeedLayout = true;
		$GLOBALS['%s']->pop();
	}}
	public function invalidateText($invalidationReason) {
		$GLOBALS['%s']->push("cocktail.core.renderer.InvalidatingElementRenderer::invalidateText");
		$製pos = $GLOBALS['%s']->length;
		$length = $this->childNodes->length;
		{
			$_g = 0;
			while($_g < $length) {
				$i = $_g++;
				$child = $this->childNodes[$i];
				if($child->isText() === true) {
					$child->invalidate($invalidationReason);
				}
				unset($i,$child);
			}
		}
		$GLOBALS['%s']->pop();
	}
	public function invalidateDocumentLayoutAndRendering() {
		$GLOBALS['%s']->push("cocktail.core.renderer.InvalidatingElementRenderer::invalidateDocumentLayoutAndRendering");
		$製pos = $GLOBALS['%s']->length;
		$htmlDocument = $this->domNode->ownerDocument;
		$htmlDocument->invalidateLayout(false);
		$htmlDocument->invalidateRendering();
		$GLOBALS['%s']->pop();
	}
	public function invalidateDocumentRendering() {
		$GLOBALS['%s']->push("cocktail.core.renderer.InvalidatingElementRenderer::invalidateDocumentRendering");
		$製pos = $GLOBALS['%s']->length;
		$htmlDocument = $this->domNode->ownerDocument;
		$htmlDocument->invalidateRendering();
		$GLOBALS['%s']->pop();
	}
	public function invalidateDocumentLayout($immediate) {
		$GLOBALS['%s']->push("cocktail.core.renderer.InvalidatingElementRenderer::invalidateDocumentLayout");
		$製pos = $GLOBALS['%s']->length;
		$htmlDocument = $this->domNode->ownerDocument;
		$htmlDocument->invalidateLayout($immediate);
		$GLOBALS['%s']->pop();
	}
	public function invalidatedPositionedChildStyle($styleName, $invalidationReason) {
		$GLOBALS['%s']->push("cocktail.core.renderer.InvalidatingElementRenderer::invalidatedPositionedChildStyle");
		$製pos = $GLOBALS['%s']->length;
		switch($styleName) {
		case "background-color":case "background-clip":case "background-image":case "background-position":case "background-origin":case "background-repeat":case "background-size":{
		}break;
		default:{
			$this->_positionedChildrenNeedLayout = true;
			$this->invalidateDocumentLayoutAndRendering();
		}break;
		}
		$GLOBALS['%s']->pop();
	}
	public function invalidatedChildStyle($styleName, $invalidationReason) {
		$GLOBALS['%s']->push("cocktail.core.renderer.InvalidatingElementRenderer::invalidatedChildStyle");
		$製pos = $GLOBALS['%s']->length;
		switch($styleName) {
		case "background-color":case "background-clip":case "background-image":case "background-position":case "background-origin":case "background-repeat":case "background-size":{
		}break;
		default:{
			$this->_needsLayout = true;
			$this->invalidateDocumentLayoutAndRendering();
		}break;
		}
		$GLOBALS['%s']->pop();
	}
	public function invalidatedStyle($styleName, $invalidationReason) {
		$GLOBALS['%s']->push("cocktail.core.renderer.InvalidatingElementRenderer::invalidatedStyle");
		$製pos = $GLOBALS['%s']->length;
		switch($styleName) {
		case "left":case "right":case "top":case "bottom":{
			if($this->isPositioned() === true && $this->isRelativePositioned() === false) {
				$this->_needsLayout = true;
				$this->invalidateContainingBlock($invalidationReason);
			} else {
				$this->invalidateDocumentRendering();
			}
		}break;
		case "color":case "font-family":case "font-size":case "font-variant":case "font-style":case "font-weight":case "letter-spacing":case "text-transform":case "white-space":{
			$this->invalidateText($invalidationReason);
			$this->_needsLayout = true;
			$this->invalidateContainingBlock($invalidationReason);
		}break;
		case "background-color":case "background-clip":case "background-image":case "background-position":case "background-origin":case "background-repeat":case "background-size":{
			$this->invalidateDocumentRendering();
		}break;
		default:{
			$this->_needsLayout = true;
			$this->invalidateContainingBlock($invalidationReason);
		}break;
		}
		$GLOBALS['%s']->pop();
	}
	public function invalidateContainingBlock($invalidationReason) {
		$GLOBALS['%s']->push("cocktail.core.renderer.InvalidatingElementRenderer::invalidateContainingBlock");
		$製pos = $GLOBALS['%s']->length;
		if($this->parentNode === null) {
			$GLOBALS['%s']->pop();
			return;
		}
		$containingBlockInvalidationReason = null;
		$裨 = ($invalidationReason);
		switch($裨->index) {
		case 0:
		$styleName = $裨->params[0];
		{
			if($this->isPositioned() === true) {
				$containingBlockInvalidationReason = cocktail_core_renderer_InvalidationReason::positionedChildStyleChanged($styleName);
			} else {
				$containingBlockInvalidationReason = cocktail_core_renderer_InvalidationReason::childStyleChanged($styleName);
			}
		}break;
		default:{
			$containingBlockInvalidationReason = $invalidationReason;
		}break;
		}
		if($this->isPositioned() === true && $this->isRelativePositioned() === false) {
			$this->_containingBlock->positionedChildInvalidated($containingBlockInvalidationReason);
		} else {
			$this->_containingBlock->childInvalidated($containingBlockInvalidationReason);
		}
		$GLOBALS['%s']->pop();
	}
	public function positionedChildInvalidated($invalidationReason) {
		$GLOBALS['%s']->push("cocktail.core.renderer.InvalidatingElementRenderer::positionedChildInvalidated");
		$製pos = $GLOBALS['%s']->length;
		$this->invalidate($invalidationReason);
		$GLOBALS['%s']->pop();
	}
	public function childInvalidated($invalidationReason) {
		$GLOBALS['%s']->push("cocktail.core.renderer.InvalidatingElementRenderer::childInvalidated");
		$製pos = $GLOBALS['%s']->length;
		$this->invalidate($invalidationReason);
		$GLOBALS['%s']->pop();
	}
	public function invalidate($invalidationReason) {
		$GLOBALS['%s']->push("cocktail.core.renderer.InvalidatingElementRenderer::invalidate");
		$製pos = $GLOBALS['%s']->length;
		if($this->layerRenderer !== null) {
			$this->layerRenderer->invalidateRendering();
		}
		$裨 = ($invalidationReason);
		switch($裨->index) {
		case 0:
		$styleName = $裨->params[0];
		{
			$this->invalidatedStyle($styleName, $invalidationReason);
		}break;
		case 1:
		$styleName = $裨->params[0];
		{
			$this->invalidatedChildStyle($styleName, $invalidationReason);
		}break;
		case 2:
		$styleName = $裨->params[0];
		{
			$this->invalidatedPositionedChildStyle($styleName, $invalidationReason);
		}break;
		case 3:
		{
			$this->invalidateDocumentLayout(true);
		}break;
		case 5:
		{
			$this->_needsLayout = true;
			$this->_childrenNeedLayout = true;
			$this->_positionedChildrenNeedLayout = true;
			$this->invalidateDocumentLayoutAndRendering();
		}break;
		case 4:
		{
			$this->invalidateDocumentRendering();
		}break;
		case 6:
		{
			$this->_needsLayout = true;
			$this->_childrenNeedLayout = true;
			$this->_positionedChildrenNeedLayout = true;
			$this->invalidateContainingBlock($invalidationReason);
		}break;
		}
		$GLOBALS['%s']->pop();
	}
	public $_positionedChildrenNeedLayout;
	public $_childrenNeedLayout;
	public $_needsLayout;
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->蜿ynamics[$m]) && is_callable($this->蜿ynamics[$m]))
			return call_user_func_array($this->蜿ynamics[$m], $a);
		else if('toString' == $m)
			return $this->__toString();
		else
			throw new HException('Unable to call �'.$m.'�');
	}
	static $__properties__ = array("set_bounds" => "set_bounds","get_bounds" => "get_bounds","get_globalBounds" => "get_globalBounds","get_scrollableBounds" => "get_scrollableBounds","set_scrollLeft" => "set_scrollLeft","get_scrollLeft" => "get_scrollLeft","set_scrollTop" => "set_scrollTop","get_scrollTop" => "get_scrollTop","get_scrollWidth" => "get_scrollWidth","get_scrollHeight" => "get_scrollHeight","get_firstChild" => "get_firstChild","get_lastChild" => "get_lastChild","get_nextSibling" => "get_nextSibling","get_previousSibling" => "get_previousSibling","set_onclick" => "set_onClick","set_ondblclick" => "set_onDblClick","set_onmousedown" => "set_onMouseDown","set_onmouseup" => "set_onMouseUp","set_onmouseover" => "set_onMouseOver","set_onmouseout" => "set_onMouseOut","set_onmousemove" => "set_onMouseMove","set_onmousewheel" => "set_onMouseWheel","set_onkeydown" => "set_onKeyDown","set_onkeyup" => "set_onKeyUp","set_onfocus" => "set_onFocus","set_onblur" => "set_onBlur","set_onresize" => "set_onResize","set_onfullscreenchange" => "set_onFullScreenChange","set_onscroll" => "set_onScroll","set_onload" => "set_onLoad","set_onerror" => "set_onError","set_onloadstart" => "set_onLoadStart","set_onprogress" => "set_onProgress","set_onsuspend" => "set_onSuspend","set_onemptied" => "set_onEmptied","set_onstalled" => "set_onStalled","set_onloadedmetadata" => "set_onLoadedMetadata","set_onloadeddata" => "set_onLoadedData","set_oncanplay" => "set_onCanPlay","set_oncanplaythrough" => "set_onCanPlayThrough","set_onplaying" => "set_onPlaying","set_onwaiting" => "set_onWaiting","set_onseeking" => "set_onSeeking","set_onseeked" => "set_onSeeked","set_onended" => "set_onEnded","set_ondurationchange" => "set_onDurationChanged","set_ontimeupdate" => "set_onTimeUpdate","set_onplay" => "set_onPlay","set_onpause" => "set_onPause","set_onvolumechange" => "set_onVolumeChange","set_ontransitionend" => "set_onTransitionEnd");
	function __toString() { return 'cocktail.core.renderer.InvalidatingElementRenderer'; }
}
