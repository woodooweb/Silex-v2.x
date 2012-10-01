<?php

class cocktail_core_renderer_ElementRenderer extends cocktail_core_dom_NodeBase {
	public function __construct($domNode) {
		if(!php_Boot::$skip_constructor) {
		parent::__construct();
		$this->domNode = $domNode;
		$this->_hasOwnLayer = false;
		$this->_wasPositioned = false;
		$this->set_bounds(new cocktail_core_geom_RectangleVO(0.0, 0.0, 0.0, 0.0));
		$this->scrollOffset = new cocktail_core_geom_PointVO(0.0, 0.0);
		$this->positionedOrigin = new cocktail_core_geom_PointVO(0.0, 0.0);
		$this->globalPositionnedAncestorOrigin = new cocktail_core_geom_PointVO(0.0, 0.0);
		$this->globalContainingBlockOrigin = new cocktail_core_geom_PointVO(0.0, 0.0);
		$this->lineBoxes = new _hx_array(array());
	}}
	public function get_scrollHeight() {
		return $this->get_bounds()->height;
	}
	public function get_scrollWidth() {
		return $this->get_bounds()->width;
	}
	public function set_scrollTop($value) {
		return $value;
	}
	public function get_scrollTop() {
		return 0;
	}
	public function set_scrollLeft($value) {
		return $value;
	}
	public function get_scrollLeft() {
		return 0;
	}
	public function set_bounds($value) {
		return $this->bounds = $value;
	}
	public function get_bounds() {
		return $this->bounds;
	}
	public function get_scrollableBounds() {
		if($this->isRelativePositioned() === false) {
			return $this->get_bounds();
		}
		$relativeOffset = $this->getRelativeOffset();
		$bounds = $this->get_bounds();
		return new cocktail_core_geom_RectangleVO($bounds->x + $relativeOffset->x, $bounds->y + $relativeOffset->y, $bounds->width, $bounds->height);
	}
	public function get_globalBounds() {
		$globalX = null;
		$globalY = null;
		$bounds = $this->get_bounds();
		$positionKeyword = $this->coreStyle->getKeyword($this->coreStyle->get_position());
		if($positionKeyword === cocktail_core_css_CSSKeywordValue::$FIXED) {
			if($this->coreStyle->isAuto($this->coreStyle->get_left()) === true && $this->coreStyle->isAuto($this->coreStyle->get_right()) === true) {
				$globalX = $this->globalContainingBlockOrigin->x + $bounds->x;
			} else {
				$globalX = $this->positionedOrigin->x;
			}
			if($this->coreStyle->isAuto($this->coreStyle->get_top()) === true && $this->coreStyle->isAuto($this->coreStyle->get_bottom()) === true) {
				$globalY = $this->globalContainingBlockOrigin->y + $bounds->y;
			} else {
				$globalY = $this->positionedOrigin->y;
			}
		} else {
			if($positionKeyword === cocktail_core_css_CSSKeywordValue::$ABSOLUTE) {
				if($this->coreStyle->isAuto($this->coreStyle->get_left()) === true && $this->coreStyle->isAuto($this->coreStyle->get_right()) === true) {
					$globalX = $this->globalContainingBlockOrigin->x + $bounds->x;
				} else {
					$globalX = $this->globalPositionnedAncestorOrigin->x + $this->positionedOrigin->x;
				}
				if($this->coreStyle->isAuto($this->coreStyle->get_top()) === true && $this->coreStyle->isAuto($this->coreStyle->get_bottom()) === true) {
					$globalY = $this->globalContainingBlockOrigin->y + $bounds->y;
				} else {
					$globalY = $this->globalPositionnedAncestorOrigin->y + $this->positionedOrigin->y;
				}
			} else {
				$globalX = $this->globalContainingBlockOrigin->x + $bounds->x;
				$globalY = $this->globalContainingBlockOrigin->y + $bounds->y;
			}
		}
		return new cocktail_core_geom_RectangleVO($globalX, $globalY, $bounds->width, $bounds->height);
	}
	public function invalidate($invalidationReason) {
	}
	public function getChildrenBounds($childrenBounds) {
		$bounds = null;
		$left = 50000;
		$top = 50000;
		$right = -50000;
		$bottom = -50000;
		$length = $childrenBounds->length;
		{
			$_g = 0;
			while($_g < $length) {
				$i = $_g++;
				$childBounds = $childrenBounds[$i];
				if($childBounds->x < $left) {
					$left = $childBounds->x;
				}
				if($childBounds->y < $top) {
					$top = $childBounds->y;
				}
				if($childBounds->x + $childBounds->width > $right) {
					$right = $childBounds->x + $childBounds->width;
				}
				if($childBounds->y + $childBounds->height > $bottom) {
					$bottom = $childBounds->y + $childBounds->height;
				}
				unset($i,$childBounds);
			}
		}
		$bounds = new cocktail_core_geom_RectangleVO($left, $top, $right - $left, $bottom - $top);
		if($bounds->width < 0) {
			$bounds->width = 0;
		}
		if($bounds->height < 0) {
			$bounds->height = 0;
		}
		return $bounds;
	}
	public function getFirstBlockContainer() {
		$parent = $this->parentNode;
		while($parent->isBlockContainer() === false) {
			$parent = $parent->parentNode;
		}
		return $parent;
	}
	public function getInitialContainingBlock() {
		return $this->domNode->ownerDocument->documentElement->elementRenderer;
	}
	public function getFirstPositionedAncestor() {
		$parent = $this->parentNode;
		while($parent->isPositioned() === false) {
			if($parent->parentNode === null) {
				break;
			}
			$parent = $parent->parentNode;
		}
		return $parent;
	}
	public function getContainingBlock() {
		if($this->isPositioned() === true && $this->isRelativePositioned() === false) {
			if($this->coreStyle->getKeyword($this->coreStyle->get_position()) == cocktail_core_css_CSSKeywordValue::$FIXED) {
				return $this->getInitialContainingBlock();
			} else {
				return $this->getFirstPositionedAncestor();
			}
		} else {
			return $this->getFirstBlockContainer();
		}
	}
	public function createLayer($parentLayer) {
		if($this->createOwnLayer() === true) {
			$this->layerRenderer = new cocktail_core_layer_LayerRenderer($this);
			$parentLayer->appendChild($this->layerRenderer);
			$this->_hasOwnLayer = true;
		} else {
			$this->layerRenderer = $parentLayer;
		}
	}
	public function rendersAsIfCreateOwnLayer() {
		return false;
	}
	public function getRelativeOffset() {
		$relativeOffset = new cocktail_core_geom_PointVO(0.0, 0.0);
		if($this->isRelativePositioned() === true) {
			if($this->coreStyle->isAuto($this->coreStyle->get_left()) === false) {
				$relativeOffset->x += $this->coreStyle->usedValues->left;
			} else {
				if($this->coreStyle->isAuto($this->coreStyle->get_right()) === false) {
					$relativeOffset->x -= $this->coreStyle->usedValues->right;
				}
			}
			if($this->coreStyle->isAuto($this->coreStyle->get_top()) === false) {
				$relativeOffset->y += $this->coreStyle->usedValues->top;
			} else {
				if($this->coreStyle->isAuto($this->coreStyle->get_bottom()) === false) {
					$relativeOffset->y -= $this->coreStyle->usedValues->bottom;
				}
			}
		}
		return $relativeOffset;
	}
	public function createOwnLayer() {
		return false;
	}
	public function isVisible() {
		return true;
	}
	public function isTransformed() {
		return false;
	}
	public function isAnonymousBlockBox() {
		return false;
	}
	public function childrenInline() {
		return false;
	}
	public function isBlockContainer() {
		return false;
	}
	public function isTransparent() {
		return false;
	}
	public function isRelativePositioned() {
		return false;
	}
	public function isText() {
		return false;
	}
	public function isReplaced() {
		return false;
	}
	public function isInlineLevel() {
		return false;
	}
	public function isPositioned() {
		return false;
	}
	public function isFloat() {
		return false;
	}
	public function isScrollBar() {
		return false;
	}
	public function establishesNewFormattingContext() {
		return false;
	}
	public function isHorizontallyScrollable($scrollOffset) {
		return false;
	}
	public function isVerticallyScrollable($scrollOffset) {
		return false;
	}
	public function unregisterWithContainingBlock() {
		if($this->_wasPositioned === true) {
			$this->_containingBlock->removePositionedChild($this);
			$this->_wasPositioned = false;
		}
	}
	public function registerWithContaininingBlock() {
		if($this->isPositioned() === true) {
			$this->_containingBlock->addPositionedChildren($this);
			$this->_wasPositioned = true;
		}
	}
	public function detachLayer() {
		if($this->_hasOwnLayer === true) {
			$parent = $this->parentNode;
			$parent->layerRenderer->removeChild($this->layerRenderer);
			$this->_hasOwnLayer = false;
		}
		$this->layerRenderer = null;
	}
	public function attachLayer() {
		if($this->layerRenderer === null) {
			if($this->parentNode !== null) {
				$parent = $this->parentNode;
				if($parent->layerRenderer !== null) {
					$this->createLayer($parent->layerRenderer);
				}
			}
		}
	}
	public function detach() {
		$this->unregisterWithContainingBlock();
		$this->_containingBlock = null;
		$length = $this->childNodes->length;
		{
			$_g = 0;
			while($_g < $length) {
				$i = $_g++;
				$child = $this->childNodes[$i];
				$child->detach();
				unset($i,$child);
			}
		}
		$this->detachLayer();
	}
	public function attach() {
		$this->attachLayer();
		$length = $this->childNodes->length;
		{
			$_g = 0;
			while($_g < $length) {
				$i = $_g++;
				$child = $this->childNodes[$i];
				$child->attach();
				unset($i,$child);
			}
		}
		$this->_containingBlock = $this->getContainingBlock();
		$this->registerWithContaininingBlock();
	}
	public function setGlobalOrigins($addedX, $addedY, $addedPositionedX, $addedPositionedY, $addedScrollX, $addedScrollY) {
		if($this->establishesNewFormattingContext() === true) {
			$globalBounds = $this->get_globalBounds();
			$addedX = $globalBounds->x;
			$addedY = $globalBounds->y;
		}
		if($this->isPositioned() === true) {
			$globalBounds = $this->get_globalBounds();
			$addedPositionedX = $globalBounds->x;
			$addedPositionedY = $globalBounds->y;
		}
		if($this->coreStyle->getKeyword($this->coreStyle->get_position()) != cocktail_core_css_CSSKeywordValue::$FIXED) {
			$addedScrollX += $this->get_scrollLeft();
			$addedScrollY += $this->get_scrollTop();
		} else {
			$addedScrollX = 0;
			$addedScrollY = 0;
		}
		$length = $this->childNodes->length;
		{
			$_g = 0;
			while($_g < $length) {
				$i = $_g++;
				$child = $this->childNodes[$i];
				$currentChildGlobalBounds = $child->get_globalBounds();
				$child->globalContainingBlockOrigin->x = $addedX;
				$child->globalContainingBlockOrigin->y = $addedY;
				$child->globalPositionnedAncestorOrigin->x = $addedPositionedX;
				$child->globalPositionnedAncestorOrigin->y = $addedPositionedY;
				$child->scrollOffset->x = $addedScrollX;
				$child->scrollOffset->y = $addedScrollY;
				$newChildGlobalBounds = $child->get_globalBounds();
				if($currentChildGlobalBounds->x !== $newChildGlobalBounds->x || $currentChildGlobalBounds->y !== $newChildGlobalBounds->y || $currentChildGlobalBounds->width !== $newChildGlobalBounds->width || $currentChildGlobalBounds->height !== $newChildGlobalBounds->height) {
					$child->layerRenderer->invalidateRendering();
				}
				if($child->hasChildNodes() === true) {
					$child->setGlobalOrigins($addedX, $addedY, $addedPositionedX, $addedPositionedY, $addedScrollX, $addedScrollY);
				}
				unset($newChildGlobalBounds,$i,$currentChildGlobalBounds,$child);
			}
		}
	}
	public function layout($forceLayout) {
	}
	public function renderScrollBars($graphicContext, $windowWidth, $windowHeight) {
	}
	public function render($parentGraphicContext) {
	}
	public function removeChild($oldChild) {
		$oldChild->detach();
		parent::removeChild($oldChild);
		$this->invalidate(cocktail_core_renderer_InvalidationReason::$other);
		return $oldChild;
	}
	public function appendChild($newChild) {
		parent::appendChild($newChild);
		$newChild->attach();
		$this->invalidate(cocktail_core_renderer_InvalidationReason::$other);
		return $newChild;
	}
	public $_containingBlock;
	public $scrollHeight;
	public $scrollWidth;
	public $scrollTop;
	public $scrollLeft;
	public $_wasPositioned;
	public $_hasOwnLayer;
	public $lineBoxes;
	public $layerRenderer;
	public $coreStyle;
	public $domNode;
	public $scrollOffset;
	public $globalPositionnedAncestorOrigin;
	public $positionedOrigin;
	public $globalContainingBlockOrigin;
	public $scrollableBounds;
	public $globalBounds;
	public $bounds;
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->�dynamics[$m]) && is_callable($this->�dynamics[$m]))
			return call_user_func_array($this->�dynamics[$m], $a);
		else if('toString' == $m)
			return $this->__toString();
		else
			throw new HException('Unable to call �'.$m.'�');
	}
	static $__properties__ = array("set_bounds" => "set_bounds","get_bounds" => "get_bounds","get_globalBounds" => "get_globalBounds","get_scrollableBounds" => "get_scrollableBounds","set_scrollLeft" => "set_scrollLeft","get_scrollLeft" => "get_scrollLeft","set_scrollTop" => "set_scrollTop","get_scrollTop" => "get_scrollTop","get_scrollWidth" => "get_scrollWidth","get_scrollHeight" => "get_scrollHeight","get_firstChild" => "get_firstChild","get_lastChild" => "get_lastChild","get_nextSibling" => "get_nextSibling","get_previousSibling" => "get_previousSibling","set_onclick" => "set_onClick","set_ondblclick" => "set_onDblClick","set_onmousedown" => "set_onMouseDown","set_onmouseup" => "set_onMouseUp","set_onmouseover" => "set_onMouseOver","set_onmouseout" => "set_onMouseOut","set_onmousemove" => "set_onMouseMove","set_onmousewheel" => "set_onMouseWheel","set_onkeydown" => "set_onKeyDown","set_onkeyup" => "set_onKeyUp","set_onfocus" => "set_onFocus","set_onblur" => "set_onBlur","set_onresize" => "set_onResize","set_onfullscreenchange" => "set_onFullScreenChange","set_onscroll" => "set_onScroll","set_onload" => "set_onLoad","set_onerror" => "set_onError","set_onloadstart" => "set_onLoadStart","set_onprogress" => "set_onProgress","set_onsuspend" => "set_onSuspend","set_onemptied" => "set_onEmptied","set_onstalled" => "set_onStalled","set_onloadedmetadata" => "set_onLoadedMetadata","set_onloadeddata" => "set_onLoadedData","set_oncanplay" => "set_onCanPlay","set_oncanplaythrough" => "set_onCanPlayThrough","set_onplaying" => "set_onPlaying","set_onwaiting" => "set_onWaiting","set_onseeking" => "set_onSeeking","set_onseeked" => "set_onSeeked","set_onended" => "set_onEnded","set_ondurationchange" => "set_onDurationChanged","set_ontimeupdate" => "set_onTimeUpdate","set_onplay" => "set_onPlay","set_onpause" => "set_onPause","set_onvolumechange" => "set_onVolumeChange","set_ontransitionend" => "set_onTransitionEnd");
	function __toString() { return 'cocktail.core.renderer.ElementRenderer'; }
}
