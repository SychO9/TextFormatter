var MSXML = (typeof DOMParser === 'undefined' || typeof XSLTProcessor === 'undefined');
var xslt = {
	/**
	* @param {string} xsl
	*/
	init: function(xsl)
	{
		var stylesheet = xslt.loadXML(xsl);
		if (MSXML)
		{
			var generator = new ActiveXObject('MSXML2.XSLTemplate.6.0');
			generator['stylesheet'] = stylesheet;
			xslt.proc = generator['createProcessor']();
		}
		else
		{
			xslt.proc = new XSLTProcessor;
			xslt.proc['importStylesheet'](stylesheet);
		}
	},

	/**
	* @param  {string} xml
	* @return {!Document}
	*/
	loadXML: function(xml)
	{
		var dom;
		if (MSXML)
		{
			dom = new ActiveXObject('MSXML2.FreeThreadedDOMDocument.6.0');
			dom['async'] = false;
			dom['validateOnParse'] = false;
			dom['loadXML'](xml);
		}
		else
		{
			dom = (new DOMParser).parseFromString(xml, 'text/xml');
		}

		if (!dom)
		{
			throw 'Cannot parse ' + xml;
		}

		return dom;
	},

	/**
	* @param {string} paramName  Parameter name
	* @param {string} paramValue Parameter's value
	*/
	setParameter: function(paramName, paramValue)
	{
		if (MSXML)
		{
			xslt.proc['addParameter'](paramName, paramValue, '');
		}
		else
		{
			xslt.proc['setParameter'](null, paramName, paramValue);
		}
	},

	/**
	* @param  {string}    xml
	* @param  {!Document} targetDoc
	* @return {!DocumentFragment}
	*/
	transformToFragment: function(xml, targetDoc)
	{
		if (MSXML)
		{
			var div = targetDoc.createElement('div'),
				fragment = targetDoc.createDocumentFragment();

			xslt.proc['input'] = xslt.loadXML(xml);
			xslt.proc['transform']();
			div.innerHTML = xslt.proc['output'];
			while (div.firstChild)
			{
				fragment.appendChild(div.firstChild);
			}

			return fragment;
		}

		return xslt.proc['transformToFragment'](xslt.loadXML(xml), targetDoc);
	}
};
xslt.init(xsl);

var functionCache = {};

/**
* Parse a given text and render it into given HTML element
*
* @param  {string} text
* @param  {!HTMLElement} target
* @return {!Node}
*/
function preview(text, target)
{
	var targetDoc = target.ownerDocument;
	if (!targetDoc)
	{
		throw 'Target does not have a ownerDocument';
	}

	var resultFragment = xslt.transformToFragment(parse(text).replace(/<[eis]>[^<]*<\/[eis]>/g, ''), targetDoc),
		lastUpdated    = target;

	// Apply post-processing
	if (HINT.onRender)
	{
		executeEvents(resultFragment, 'onrender');
	}

	/**
	* Execute an event's code on a given node
	*
	* @param {!Element} node
	* @param {string}   eventName
	*/
	function executeEvent(node, eventName)
	{
		/** @type {string} */
		var code = node.getAttribute('data-s9e-livepreview-' + eventName);
		if (!functionCache[code])
		{
			functionCache[code] = new Function(code);
		}

		functionCache[code]['call'](node);
	}

	/**
	* Locate and execute an event on given document fragment
	*
	* @param {!DocumentFragment} fragment
	* @param {string}            eventName
	*/
	function executeEvents(fragment, eventName)
	{
		var nodes = fragment.querySelectorAll('[data-s9e-livepreview-' + eventName + ']'),
			i     = nodes.length;
		while (--i >= 0)
		{
			executeEvent(nodes[i], eventName);
		}
	}

	/**
	* Update the content of given node oldParent to match node newParent
	*
	* @param {!Node} oldParent
	* @param {!Node} newParent
	*/
	function refreshElementContent(oldParent, newParent)
	{
		var oldNodes = oldParent.childNodes,
			newNodes = newParent.childNodes,
			oldCnt   = oldNodes.length,
			newCnt   = newNodes.length,
			oldNode,
			newNode,
			left     = 0,
			right    = 0;

		// Skip the leftmost matching nodes
		while (left < oldCnt && left < newCnt)
		{
			oldNode = oldNodes[left];
			newNode = newNodes[left];
			if (!refreshNode(oldNode, newNode))
			{
				break;
			}

			++left;
		}

		// Skip the rightmost matching nodes
		var maxRight = Math.min(oldCnt - left, newCnt - left);
		while (right < maxRight)
		{
			oldNode = oldNodes[oldCnt - (right + 1)];
			newNode = newNodes[newCnt - (right + 1)];
			if (!refreshNode(oldNode, newNode))
			{
				break;
			}

			++right;
		}

		// Remove the old dirty nodes in the middle of the tree
		var i = oldCnt - right;
		while (--i >= left)
		{
			oldParent.removeChild(oldNodes[i]);
			lastUpdated = oldParent;
		}

		// Test whether there are any nodes in the new tree between the matching nodes at the left
		// and the matching nodes at the right
		var rightBoundary = newCnt - right;
		if (left >= rightBoundary)
		{
			return;
		}

		// Clone the new nodes
		var newNodesFragment = targetDoc.createDocumentFragment();
		i = left;
		do
		{
			lastUpdated = newNodesFragment.appendChild(newNodes[i]);
		}
		while (i < --rightBoundary);

		// If we haven't skipped any nodes to the right, we can just append the fragment
		if (!right)
		{
			oldParent.appendChild(newNodesFragment);
		}
		else
		{
			oldParent.insertBefore(newNodesFragment, oldParent.childNodes[left]);
		}
	}

	/**
	* Update given node oldNode to make it match newNode
	*
	* @param {!Node} oldNode
	* @param {!Node} newNode
	* @return {boolean} Whether the node can be skipped
	*/
	function refreshNode(oldNode, newNode)
	{
		if (oldNode.nodeName !== newNode.nodeName || oldNode.nodeType !== newNode.nodeType)
		{
			return false;
		}

		if (oldNode instanceof HTMLElement && newNode instanceof HTMLElement)
		{
			if (!oldNode.isEqualNode(newNode))
			{
				syncElementAttributes(oldNode, newNode);
				refreshElementContent(oldNode, newNode);
			}
		}
		// Node.TEXT_NODE || Node.COMMENT_NODE
		else if (oldNode.nodeType === 3 || oldNode.nodeType === 8)
		{
			if (oldNode.nodeValue !== newNode.nodeValue)
			{
				oldNode.nodeValue = newNode.nodeValue;
				lastUpdated = oldNode;
			}
		}

		return true;
	}

	/**
	* Make the set of attributes of given element oldEl match newEl's
	*
	* @param {!HTMLElement} oldEl
	* @param {!HTMLElement} newEl
	*/
	function syncElementAttributes(oldEl, newEl)
	{
		var oldAttributes = oldEl['attributes'],
			newAttributes = newEl['attributes'],
			oldCnt        = oldAttributes.length,
			newCnt        = newAttributes.length,
			i             = oldCnt,
			ignoreAttrs   = ' ' + oldEl.getAttribute('data-s9e-livepreview-ignore-attrs') + ' ';

		while (--i >= 0)
		{
			var oldAttr      = oldAttributes[i],
				namespaceURI = oldAttr['namespaceURI'],
				attrName     = oldAttr['name'];

			if (HINT.ignoreAttrs && ignoreAttrs.indexOf(' ' + attrName + ' ') > -1)
			{
				continue;
			}
			if (!newEl.hasAttributeNS(namespaceURI, attrName))
			{
				oldEl.removeAttributeNS(namespaceURI, attrName);
				lastUpdated = oldEl;
			}
		}

		i = newCnt;
		while (--i >= 0)
		{
			var newAttr      = newAttributes[i],
				namespaceURI = newAttr['namespaceURI'],
				attrName     = newAttr['name'],
				attrValue    = newAttr['value'];

			if (HINT.ignoreAttrs && ignoreAttrs.indexOf(' ' + attrName + ' ') > -1)
			{
				continue;
			}
			if (attrValue !== oldEl.getAttributeNS(namespaceURI, attrName))
			{
				oldEl.setAttributeNS(namespaceURI, attrName, attrValue);
				lastUpdated = oldEl;
			}
		}
	}

	refreshElementContent(target, resultFragment);

	return lastUpdated;
}

/**
* Set the value of a stylesheet parameter
*
* @param {string} paramName  Parameter name
* @param {string} paramValue Parameter's value
*/
function setParameter(paramName, paramValue)
{
	xslt.setParameter(paramName, paramValue);
}