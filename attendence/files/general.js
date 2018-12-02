function ValidateEmail(email) {
 return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email);
}

function GetDateDiffInfo(dtBegin, dtEnd) {
	var days = Math.floor((dtEnd - dtBegin) / 1000 / 60 / 60 / 24)
	var hours = Math.floor((dtEnd - dtBegin) / 1000 / 60 / 60 - (24 * days));
	var mins = Math.floor((dtEnd - dtBegin) / 1000 /60 - (24 * 60 * days) - (60 * hours));
	var secs = Math.floor((dtEnd - dtBegin) / 1000 - (24 * 60 * 60 * days) - (60 * 60 * hours) - (60 * mins));
	return {
		days : days,
		hours : hours,
		mins : mins,
		secs : secs
		};
}

function UpdateQuTimer(id, dt, isRemaining, clearOnFinish) {
	var objTimer = document.getElementById(id);
	var timerSec = document.getElementById(id+"_sec");
	var timerMin = document.getElementById(id+"_min");
	var timerHour = document.getElementById(id+"_hour");
	var timerDay = document.getElementById(id+"_day");
	
	var curDate = new Date() - globalQUDateTimeDiff;
	var info;
	if(isRemaining) {
		if(curDate > dt) {
			if(clearOnFinish) {
				objTimer.style.display = 'none';
				return;
			}
			setTimeout(function(){ UpdateQuTimer(id, dt, false, clearOnFinish) }, 50);
			return;
		}
		info = GetDateDiffInfo(curDate, dt);
	}
	else {
		if(curDate < dt) {
			// Bu hal yaranmamaliydi
			objTimer.style.display = 'none';
			return;
		}
		info = GetDateDiffInfo(dt, curDate);
	}
	objTimer.style.display = '';
	if(timerDay != undefined) timerDay.innerText = info.days;
	if(timerHour != undefined) timerHour.innerText = info.hours;
	if(timerMin != undefined) timerMin.innerText = info.mins;
	if(timerSec != undefined) timerSec.innerText = info.secs;
	setTimeout(function(){ UpdateQuTimer(id, dt, isRemaining, clearOnFinish) }, 500);
}
	
function myPop() { 
    this.square = null;
    this.overdiv = null;

    this.popOut = function(msgtxt) {
        //filter:alpha(opacity=25);-moz-opacity:.25;opacity:.25;
        this.overdiv = document.createElement("div");
        this.overdiv.className = "overdiv";

        this.square = document.createElement("div");
        this.square.className = "square";
        this.square.Code = this;
        var msg = document.createElement("div");
        msg.className = "msg";
        msg.innerHTML = msgtxt;
        this.square.appendChild(msg);
        var closebtn = document.createElement("button");
        closebtn.onclick = function() {
            this.parentNode.Code.popIn();
        }
        closebtn.innerHTML = "Close";
        this.square.appendChild(closebtn);		

        document.body.appendChild(this.overdiv);
        document.body.appendChild(this.square);		
    }
    this.popIn = function() {
        if (this.square != null) {
            document.body.removeChild(this.square);
            this.square = null;
        }
        if (this.overdiv != null) {
        document.body.removeChild(this.overdiv);
        this.overdiv = null;
        }

    }
}    

Ajax = {
	xObjects: new Array(),
	getNewXHR: function() { 
		if (window.XMLHttpRequest) return new XMLHttpRequest();
		if (window.ActiveXObject) return new ActiveXObject("Microsoft.XMLHTTP");
		return null;
	},
	evalScript: function(data) {
		var div = document.createElement("div");
		
		while( (matched = Ajax.regexScript.exec(data)) != null ) {
			div.innerHTML += ", " + matched[0]; //BUrda vergul olmalidi. IE6 bug var.
		}
		var itemObj = div.getElementsByTagName('script');
		for(var i=0;i<itemObj.length; i++) 
		Ajax.globalEval(itemObj.item(i).innerHTML);
	},
	regexScript : /<script(.|\s)*?\/script>/gi,
	callback: function(index) {
		if(!Ajax.xObjects[index].isAdvanced && (Ajax.xObjects[index].xhr.readyState != 4 || Ajax.xObjects[index].xhr.status != 200)) {
			return;
		}
		if( Ajax.xObjects[index]["callback"]) {
			if(Ajax.xObjects[index].dataType == "html" && Ajax.xObjects[index].xhr.readyState == 4 && Ajax.xObjects[index].xhr.status == 200) {
				//Session olubse redirect ele
				RetRespWithCheck(Ajax.getXData(Ajax.xObjects[index].xhr));
				
				//Scriptleri evaluate ele, global mezmunda
				Ajax.evalScript(Ajax.getXData(Ajax.xObjects[index].xhr));
			}
			if(Ajax.xObjects[index].isAdvanced) {				
				Ajax.xObjects[index]["callback"]({data : Ajax.xObjects[index].xhr.readyState > 3 ? Ajax.getXData(Ajax.xObjects[index].xhr) : "", state : Ajax.xObjects[index].xhr.readyState, status : Ajax.xObjects[index].xhr.readyState == 4 ? Ajax.xObjects[index].xhr.status : ""});
			}
			else if (Ajax.xObjects[index].xhr.readyState == 4 && Ajax.xObjects[index].xhr.status == 200) {
				Ajax.xObjects[index]["callback"](Ajax.getXData(Ajax.xObjects[index].xhr));
			}
			////eger okdirse connection kill ele
			if(Ajax.xObjects[index].dataType == "html" && Ajax.xObjects[index].xhr.readyState == 4 && Ajax.xObjects[index].xhr.status == 200) Ajax.abortObject(index);
		}
	},
	globalEval: function(code) {
			//code = eval('code = "'+code+'"');
			//alert(code);
			var head = document.getElementsByTagName("head")[0] || document.getElementsByTagName("*")[0] || document.documentElement;
			var script = document.createElement("script");
			script.type = "text/javascript";
			script.text = code;
			head.insertBefore( script, head.firstChild );
			head.removeChild( script );
	},
	sendRequest: function(index) {
		if(Ajax.xObjects[index].dataType == "SCRIPT") {
			var head = document.getElementsByTagName("head")[0] || document.getElementsByTagName("*")[0] || document.documentElement;
			var script = document.createElement("script");
			script.type = "text/javascript";
			script.src = Ajax.xObjects[index].url;
			script.onload = script.onreadystatechange = function() {
				if(!this.readyState || this.readyState==="loaded" || this.readyState==="complete") {
					script.onload = script.onreadystatechange = null;
					if ( head && script.parentNode ) {
						head.removeChild( script );
					}
					Ajax.xObjects[index]["callback"]();
				}
			}
			head.insertBefore( script, head.firstChild );	
			return;
		}
		Ajax.xObjects[index].xhr.open(Ajax.xObjects[index]["method"], Ajax.xObjects[index]["url"], Ajax.xObjects[index]["isAsynch"]);
		if(Ajax.xObjects[index].method == "POST") {
			Ajax.xObjects[index].xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		}
		//this.requestObjects[index]["timeout"] = setTimeout(new Function (funcbodytimeout),(in_timeout_delay * 1000));
		Ajax.xObjects[index].xhr.onreadystatechange = new Function("Ajax.callback('" + index + "');");
		Ajax.xObjects[index].xhr.send(Ajax.xObjects[index].data);
	},
	getXData : function(xhr) {
		var ct = xhr.getResponseHeader("content-type") || "";
		var xml = ct.indexOf("xml") >= 0;
		return xml ? xhr.responseXML : xhr.responseText;
	},
	rnd : function() {
		return (new Date()).getTime();
	},
	get : function(url, callback, dataType) {
		Ajax.ajax({url : url, method : "GET", callback : callback, dataType : dataType, isAdvanced : false, isAsynch : true});
	},
	post : function(url, callback, dataType) {
		Ajax.ajax({url : url, method : "POST", callback : callback, dataType : dataType, isAdvanced : false, isAsynch : true});
	},
	getScript : function(url, callback) {
		Ajax.get(url, callback, "SCRIPT");
	},
	abortObject: function(index) {
		if(!Ajax.xObjects[index]) return false;
		if(Ajax.xObjects[index].xhr) {
			this.xObjects[index].xhr.onreadystatechange = function() {};
			this.xObjects[index].xhr.abort();
		}
		if(Ajax.xObjects[index]["timeout"]) clearTimeout(this.xObjects[index]["timeout"]);
		Ajax.xObjects[index] = null;
		return true;
	},
        getRequestBody: function(oForm){
            /*gonderilen obyektin butun elemetlerinin POST veya GET ucun requestini hazirlayir*/
            var aParams = new Array();
                    try {
                            if((typeof oForm).toLowerCase() == 'string') oForm = indexfGetElem(oForm);
                            for (var i=0 ; i < oForm.elements.length; i++) {
                                    if((oForm.elements[i].type == "checkbox" || oForm.elements[i].type == "radio") && oForm.elements[i].checked == false) continue;
                                    var sParam = encodeURIComponent(oForm.elements[i].name == "" ? oForm.elements[i].id ? oForm.elements[i].id : "" : oForm.elements[i].name);
                                    sParam += "=";
                                    sParam += encodeURIComponent(oForm.elements[i].value);
                                    aParams.push(sParam);
                            }
                    } catch(err) { indexfAlertError(err, 'indexfGetRequestBody');	}
            return aParams.join("&");
        },
	abortAllConnections : function() {
		var aborted = 0;
		//alert("Aborting ");
		for(var i in Ajax.xObjects) {
			if(Ajax.abortObject(i)) aborted ++;
		}
		//alert(aborted + " connections aborted!");
	},
	ajax: function(settings) {
		if(typeof settings.url == "undefined") return false;
		if(typeof settings.method == "undefined") settings.method = "GET";
		else settings.method = settings.method.toUpperCase() === "POST" ? "POST" : "GET";
		if(typeof settings.dataType == "undefined") settings.dataType = "html";
		if(typeof settings.isAdvanced == "undefined") settings.isAdvanced = true;
		if(typeof settings.isAsynch == "undefined") settings.isAsynch = true;
		if(typeof settings.abort_prevs == "undefined") settings.abort_prevs = false;
		else if(settings.abort_prevs) Ajax.abortAllConnections();
		if(typeof settings.index == "undefined" || settings.index == null) {
			settings.index = 0;
			while(Ajax.xObjects[settings.index] && typeof Ajax.xObjects[settings.index] != "undefined") { settings.index ++; }
		} else {
			
			//Evvelceden qalibsa abort ele
			if(Ajax.xObjects[settings.index] && typeof(Ajax.xObjects[settings.index]) != "undefined") {
				Ajax.abortObject(settings.index);
			}
		}
		var data = null;
		var ind = settings.url.indexOf("?");
		if(ind == -1) settings.url += "?" + Ajax.rnd();
		else settings.url += "&" + Ajax.rnd();
		if(settings.method == "POST" && ind >= 0) {
			settings.data = settings.url.substring(ind+1, settings.url.length);
			settings.url = settings.url.substring(0, ind);
		}
		Ajax.xObjects[settings.index] = new Array();
		Ajax.xObjects[settings.index] = {xhr : this.getNewXHR(),
									method : settings.method,
									url : settings.url,
									data : settings.data,
									dataType : settings.dataType,
									index : settings.index,
									isAsynch : settings.isAsynch,
									callback : settings.callback,
									isAdvanced : settings.isAdvanced,
									timeout : null,
									timeout_callback : settings.timeout_callback,
									timeout_delay : settings.timeout_delay,
									abort_prevs : settings.abort_prevs,
									aborted : false
									};
		Ajax.sendRequest(settings.index);
		return true;
	}
}	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function ShowAjaxLoadImage(msg) {
		if( typeof msg === 'undefined' ) msg = "Loading...";
		var al = document.getElementById("ajaxLoading");
		al.innerHTML = msg;
		al.style.display = 'inline';
	}
	
	function HideAjaxLoadImage() {
		var al = document.getElementById("ajaxLoading");
		al.innerHTML = "";
		al.style.display = 'none';
	}
	
	
	
    function findPos(obj) {
        var curleft = curtop = 0;
        if (obj.offsetParent) {
            do {
                curleft += obj.offsetLeft;
                curtop += obj.offsetTop;
            } while (obj = obj.offsetParent);
        }
        return [curleft,curtop];
    }
	
	
	
	String.prototype.trim = function() {
		return this.replace(/^\s+|\s+$/g,"");
	}
	String.prototype.ltrim = function() {
		return this.replace(/^\s+/,"");
	}
	String.prototype.rtrim = function() {
		return this.replace(/\s+$/,"");
	}	
	
	String.prototype.replaceAll=function(old, rep ){
		foundat = 0;
		ret = this;
		do {
			foundat = ret.indexOf(old, foundat);
			if (foundat!=-1) {
				ret = ret.substring(0,foundat)+rep+ret.substr(foundat+1);
				foundat += rep.length;
			}
		} while (foundat!=-1);
		return ret;
	}
	
	function indexfGetIFrameDocument(id) {   
	  	var obj = indexfGetElem(id);
		var doc = obj.contentDocument;
		if (doc == undefined) // Internet Explorer
		doc = obj.contentWindow.document;
		return doc;
	}

	function indexfGetTime() {
		var current_timestamp = new Date();
		return current_timestamp.getTime();		
	}
	
	function indexfDiffTime(timestamp) {
		var current_timestamp = new Date();
		return (current_timestamp.getTime()-timestamp);	
	}
	
	function indexfIsNumeric(sText) {
		var ValidChars = "0123456789.";
		var IsNumber=true;
		var Char;
		for (i = 0; i < sText.length && IsNumber == true; i++) {
			Char = sText.charAt(i);
			if (ValidChars.indexOf(Char) == -1) {
				IsNumber = false;
			}
		}
		return IsNumber;
	}
	
	function indexfAllowNum(e){
		//if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;
		//if (event.keyCode < 45 || event.keyCode > 57) return false;
		//onKeyPress="return indexfAllowNum(event)"
		var keynum;
		var keychar;
		var numcheck;
		var isCTRLkey = false;
		
		// IE
		if(window.event) keynum = e.keyCode;
		// Netscape/Firefox/Opera
		else if(e.which) keynum = e.which;
		
		// Enable, BACKSPACE - DELETE - LEFT and RIGHT KEYS - CTRL + V - SHIFT + INSETR keys...
		isCTRLkey = ("8#37#39#46#96#97#98#99#100#101#102#103#104#105".indexOf(keynum) >= 0) || (e.ctrlKey && "86#118".indexOf(keynum) >= 0) || (e.shiftKey && keynum == 45);
		keychar = String.fromCharCode(keynum);
		numcheck = /\d/;
		
		return numcheck.test(keychar) || isCTRLkey;
	}

	function indexfGetElem(id) {		
		return document.getElementById(id);
	}
	
	function indexfVal(id) {
		return document.getElementById(id).value;
	}
	
	function indexfGeneratePassword(length) {
		var keylist="abcdefghijklmnopqrstuvwxyz123456789";
		var temp='';
		for (i=0; i<length; i++) temp += keylist.charAt(Math.floor(Math.random()*keylist.length));
		return temp;
	}
	
	function indexfSetTopWindow() {
		if (window != top) top.location.href = location.href;
	}
	
	function indexfBlockError() {
		window.onerror = function () { return true; };
	}
	
	//verilen objectin şəffavlığını təyin edir 0-100 arası
	function indexfChangeOpacity(object, opacity) {
		object = object.style;
    	object.opacity = (opacity / 100);
    	object.MozOpacity = (opacity / 100);
    	object.KhtmlOpacity = (opacity / 100);
    	object.filter = "alpha(opacity=" + opacity + ")";
	}
	
	function indexfFindChilds(obj, conditionsArray, callbackFunc) {
		/* This script is written by Shamil Mehdiyev, supervisor@box.az */
		var temp = [];
		var node;
		var indexfQuote;
		
		if(obj.childNodes && obj.childNodes.length) {
			for(var i=0;i<obj.childNodes.length; i++) {
				var allpassed = true;
				node =  obj.childNodes[i];
				for(var j=0; j<conditionsArray.length; j++) { //openDOMBrowser(nodes[i])
					indexfQuote = "'";
					if(typeof(conditionsArray[j][1]) == 'boolean') indexfQuote = "";
					if( !eval("node."+conditionsArray[j][0]+" == "+indexfQuote+conditionsArray[j][1]+indexfQuote ) ) {
						allpassed = false;
						break;
					}
				}
				if(allpassed) {
					///demek sertler odendi
					if(typeof callbackFunc == 'function') {
						callbackFunc(node);
					}	
					temp[temp.length] = node; 
				}
				if(node.childNodes && node.childNodes.length) {
					temp = temp.concat(indexfFindChilds(node,conditionsArray, callbackFunc));
				}
			}		
		}//endif
		return temp;
	}
	
	
	function indexfSetCurrentddd(obj) {
		var objs = indexfFindChilds(indexfGetElem("frm_ext"), [['tagName', 'SELECT']]) ;
		for (var i=0; i<objs.length;i++) {
			//alert(objs[i])
			objs[i].style.visibility="visible";
		}
	}

	/** TABBED PAGES
			<ol id="tabcontrol">
				<li class="current"><a onclick="setCurrentTab(this);" href=""><span>Page1</span></a></li>
				<li><a onclick="setCurrentTab(this);" href=""><span>Page2</span></a></li>
				<li><a onclick="setCurrentTab(this);" href=""><span>Page3</span></a></li>
				<li><a onclick="setCurrentTab(this);" href=""><span>Page4</span></a></li>
			</ol>
	
	*/
	
	function indexfSetCurrentTab(obj) {
		var objs = indexfFindChilds(indexfGetElem("tabcontrol"), [['tagName', 'LI']]) ;
		for (o in objs) {
			if (objs[o] != obj.parentNode) objs[o].className = "";
			else objs[o].className = "current";
		}
	}

	//////////////////////////////////////////////////////////////////////////////
	//////  AJAX FUNKSIYALARININ ƏVVƏLİ
	//////////////////////////////////////////////////////////////////////////////////
	var xmlHttp;
	var pattern = /<SML><EMBED><DATA>([\D\d]*)<\/DATA><\/EMBED><\/SML>/m;

	///AJAX  N OBJEKT 
	function indexfGetXmlHttpObject()
	{ 
		var objXMLHttp=null
		if (window.XMLHttpRequest) {
			objXMLHttp=new XMLHttpRequest()
		}
		else if (window.ActiveXObject){
			objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP")
		}
		return objXMLHttp
	}
	
	function PrintWinAjx(url, wintitle, winargs, winname ) {
		if( typeof winname == "undefined") winname = "win";
		if( typeof wintitle == "undefined") wintitle = "Pop up";
		if( typeof winargs == "undefined") winargs = "height=400,width=500";
		win3 = window.open('', winname, winargs);
		SimpleAJAXCall( url, function (text,p1,p2) {
		win3.document.open();win3.document.write('<html><head><link rel="stylesheet" href="css/all.css"><title>'+wintitle+'</title>');
		//win3.document.write('<link rel="stylesheet" href="style.css">');
		win3.document.write('</head><body onload="window.print();">');win3.document.write(text);
		win3.document.write('</body></html>');	win3.document.close();
		}, 'POST', '' );
		return win3;
	}

	
	function addslashes (str) {
		return (str+'').replace(/([\\"'])/g, "\\$1").replace(/\u0000/g, "\\0");
	}
		
	function indexfGetRequestBody(oForm) {
    	var aParams = new Array();
		try {
			if((typeof oForm).toLowerCase() == 'string') oForm = indexfGetElem(oForm);
			for (var i=0 ; i < oForm.elements.length; i++) {
				if((oForm.elements[i].type == "checkbox" || oForm.elements[i].type == "radio") && oForm.elements[i].checked == false) continue;
				var sParam = encodeURIComponent(oForm.elements[i].name);
				sParam += "=";
				sParam += encodeURIComponent(oForm.elements[i].value);
				aParams.push(sParam);
			}
		} catch(err) { indexfAlertError(err, 'indexfGetRequestBody');	}
    	return aParams.join("&");
	}

	function indexfAjaxGetRequest(url, codeStr) {
		if ( !xmlHttp ) xmlHttp = indexfGetXmlHttpObject();
		else if( xmlHttp.readyState != 0 ) xmlHttp.abort();
		xmlHttp = indexfGetXmlHttpObject();
		if ( codeStr.length > 0 ) {
			xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete") {
					var response = xmlHttp.responseText;
					//alert(xmlHttp.readyState);
					while(codeStr.search("{response}") != -1)
						codeStr = codeStr.replace("{response}", "response");
					eval(codeStr);
				}
			}
		}
		url = url + '&sid=' + indexfGeneratePassword(10);
		xmlHttp.open("GET", url, true);
		xmlHttp.send(null);
	}
	
	/*
	
	function(a){
	if(a&&Va.test(a)){
		var b=s.getElementsByTagName("head")[0]||s.documentElement,d=s.createElement("script");
		d.type="text/javascript";
		if(c.support.scriptEval)
		d.appendChild(s.createTextNode(a));
		else d.text=a;
		b.insertBefore(d,b.firstChild);b.removeChild(d)
}




var z=s.getElementsByTagName("head")[0]||s.documentElement,C=s.createElement("script");
C.src=e.url;if(e.scriptCharset)C.charset=e.scriptCharset;if(!j){
	var B=false;
	C.onload=C.onreadystatechange=function(){
		if(!B&&(!this.readyState||this.readyState==="loaded"||this.readyState==="complete")){
			B=true;
			b();
			d();
			C.onload=C.onreadystatechange=null;
			z&&C.parentNode&&z.removeChild(C)
			}
			}
			}z.insertBefore(C,z.firstChild);return w
	
	*/
	function indexfGlobalEval(src) {
		try{
			if (window.execScript) {
				window.execScript(src);
				return;
			}
			var fn = function() {
				window.eval.call(window,src);
			};
			fn();
		} catch(err) { indexfAlertError(err,'indexfGlobalEval');	}
	};
	
	function indexfEvalTextJavaScript(objName) {
		Ajax.evalScript(indexfGetElem(objName).innerHTML);
		return;
		itemObj = indexfGetElem(objName).getElementsByTagName('script');
		for(var sc_i=0;sc_i<itemObj.length; sc_i++) {
			indexfGlobalEval(itemObj.item(sc_i).innerHTML);
		}
	}
	
	function indexfAjaxPostRequest(formName, codeStr) {
		var formObj = document.forms[formName];
		if( !formObj ) {
			alert(formObj + ' adlı formun obyeti yaradıla bilmədi!');
			return false;
		}
		var data = indexfGetRequestBody(formObj);
		if ( !xmlHttp ) xmlHttp = indexfGetXmlHttpObject();
		else if( xmlHttp.readyState != 0 ) xmlHttp.abort();
		xmlHttp = indexfGetXmlHttpObject(); 
		xmlHttp.open("POST", formObj.action, true);
		xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		if ( codeStr.length > 0 ) {
			xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete") {
					var response = xmlHttp.responseText;
					RetRespWithCheck(response);
					//alert(xmlHttp.readyState);
					while(codeStr.search("{response}") != -1)
						codeStr = codeStr.replace("{response}", "response");
					//alert(codeStr)
					eval(codeStr);
				}
			}
		}
		xmlHttp.send(data);
	}
	
	function indexfGetShamoEmbedPart(responseText) {
		if( !pattern.test(responseText) ) return false;
		var matches = responseText.match(pattern);
		return matches[1] ? matches[1] : false;
	}
	function indexfSetCombo_(selObj, text, afterFillFunction, notfound_func) {
		try{
			RetRespWithCheck(text);
			eval(text);
			obj = indexfGetElem(selObj);
			obj.options.length=1; 
			if( typeof nArr == "undefined") return;
			for(var i=0; i<nArr.length; i++){
				obj.options[obj.options.length] = new Option(nArr[i][1], nArr[i][0]);
			}
			if(typeof afterFillFunction == 'function') {
				afterFillFunction();
			}
			if(nArr.length == 0) {
				if(typeof notfound_func == 'function') {
					notfound_func();
				}
			}
		} catch(err) { indexfAlertError(err,'indexfSetCombo_');	}
	}

	function indexfSetCombo(selObj, url, method, afterFillFunction, notfound_func) 
	{			
		if( typeof method == 'undefined') method = 'GET';
		//alert(selObj + ' - ' + url + ' - ' + method + ' - ' + afterFillFunction + ' - ' + notfound_func);
		SimpleAJAXCall( url,
			function (text,p1,p2) {
				try {		
					RetRespWithCheck(text);
					//alert(text);
					eval(text);
					obj = indexfGetElem(selObj);
					obj.options.length=1;
					if( typeof nArr == "undefined") return;
					for(var i=0; i<nArr.length; i++){
						obj.options[obj.options.length] = new Option(nArr[i][1], nArr[i][0]);
					}
					if(typeof afterFillFunction == 'function') {
						afterFillFunction();
					}
					if(nArr.length == 0) {
						if(typeof notfound_func == 'function') {
							notfound_func();
						}
					}
				} catch(err) {
				}
			}
			, method, '' );	
	}
	
	function indexfAlertError(err, funcName) {
		if(typeof funcName == 'undefined') funcName = '';
		txt="Səhifədə xəta baş verdi. Funksiya " + funcName +" \n\n";
		txt+="Xəta səbəbi: " + err.description + "\n\n";
		txt+="Davam etmək üçün OK düyməsinə basın.\n\n";
		alert(txt);		
	}
	
	function indexfSetInnerHTML(containerName,url, method, jscriptTanisin) {		
		//by shamo for the sake of natiq
		if(typeof jscriptTanisin == 'undefined') jscriptTanisin = false;
		if( typeof method == 'undefined') method = 'GET';
		SimpleAJAXCall( url,
			function (text,p1,p2) {
				RetRespWithCheck(text);
				indexfGetElem(containerName).innerHTML = text;
				if(jscriptTanisin) window.setTimeout('indexfEvalTextJavaScript(\'' + containerName + '\');', 0);
			}
			, method, '' );
	}


	
	function indexfSetComboSynch(selObj,URL,data) {		
		var http = indexfGetXmlHttpObject();
		http.open("POST",URL,false);			
		http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		http.send(data);
		RetRespWithCheck(http.responseText);
		eval(http.responseText);
		obj = indexfGetElem(selObj);
		obj.options.length=0;
		for(var i=0; i<nArr.length; i++) {
			obj.options[obj.options.length] = new Option(nArr[i][1], nArr[i][0]);
		}
		if(nArr.length == 0) obj.options[obj.options.length] = new Option("Tapılmadı", 0);		
	}
	
	
	
	
	
	
	
	//////////////////////////////////////////////////////////////////////////////
	//////  AJAX FUNKSIYALARININ SONU
	//////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	<!-- Original:  Cyanide_7 (leo7278@hotmail.com) -->
	<!-- Web Site:  http://www7.ewebcity.com/cyanide7 -->

	<!-- This script and many more are available free online at -->
	<!-- The JavaScript Source!! http://javascript.internet.com -->

	<!-- Begin
	var indexfObjects = new Array(), indexfBrowser = null, indexfExpanded = null;

	// begin objects array with the document
	indexfObjects[0] = new Array(indexfGetElem('ajaxInfoLabel'), "_document", false);

	function openDOMBrowser(object){
		// finds index of incoming object by its key
		activeIndex = arrayIndexOf(indexfObjects, "_document", 1);
		// toggles its expanded boolean
		indexfObjects[activeIndex][2] = !indexfObjects[activeIndex][2];
		// opens/reopens the window
		args = "width=500,height=600,left=20,top=20,scrollbars,resizable,top=0,left=0";
		indexfBrowser = window.open('',"DOMBrowser",args);
		indexfBrowser.focus();
		// clears the expanded array (to avoid infinate loops in the DOM)
		indexfExpanded = new Array();
		// document is about to be expanded
		indexfExpanded["_document"] = true;
		// writes HTML to the window
		indexfBrowser.document.open("text/html","replace");
		indexfBrowser.document.writeln("<HTML><HEAD><TITLE>DOM Browser</TITLE></HEAD>");
		indexfBrowser.document.writeln("<BODY BGCOLOR=BBBBBB link=FFFFF vlink=FFFFF>");
		indexfBrowser.document.writeln("<h3>document:</h3><ul>");
		// calls recurrsive property writing function
		getProps(object);
		// finishes writing HTML and closes
		indexfBrowser.document.writeln("</ul></BODY></HTML>");
		indexfBrowser.document.close();
		// returns false for event handlers
		return false;
	}
	// recurrsive function to get properties of objects
	function getProps(obj){
		// for loop to run through properties of incoming object
		for(var prop in obj){
			indexfBrowser.document.writeln("<li>");
			// if the property is an object itself, but not null...
			if(typeof(obj[prop])=="object" && obj[prop]!=null){
				// get index of object in objects array
				valIndex = arrayIndexOf(indexfObjects, obj[prop], 0);
				// if not in index array, add it and create its key
				if(valIndex==-1){
					valIndex = indexfObjects.length;
					key = ((new Date()).getTime()%10000) + "_" + (Math.floor(Math.random()*10000));
					indexfObjects[valIndex] = new Array(obj[prop], key, false);
				}
				// write link for this object to call openDOMBrowser with its key
				indexfBrowser.document.writeln("<b>"+prop+"</b> : <a href=\"javascript:void(0)\" onClick=\"window.opener.openDOMBrowser('"+ indexfObjects[valIndex][1]+"');return false;\">"+(new String(obj[prop])).replace(/</g,"<")+"</a>");
				// determine whether object should be expanded/was already expanded
				if(indexfObjects[valIndex][2] && !indexfExpanded[indexfObjects[valIndex][1]]){
					// if it needs to be expanded, add to expanded array
					indexfExpanded[indexfObjects[valIndex][1]] = true;
					// write nested list tag and recurrsive call to getProps
					indexfBrowser.document.writeln("<ul>");
					getProps(obj[prop]);
					indexfBrowser.document.writeln("</ul>");
				}
			} else
			// if not an object, just write property, value pair
			indexfBrowser.document.writeln("<b>"+prop+"</b> : " + (new String(obj[prop])).replace(/</g,"<"));
			indexfBrowser.document.writeln("</li>");
		}
	}
	
	// function to find object in an array by field value
	function arrayIndexOf(array, value, field){
		var found = false;
		var index = 0;
		while(!found && index < array.length){
			// field may be object reference or key
			if(array[index][field]==value) found = true;
			else index++;
		}
		return (found)?index:-1;
	}
	
	////////////////////////////////POP UP////////////////////////////////////////////////////////////////////
	var dragObject = null;
	var mouseOffset = null;
	
	document.onmousemove = mouseMove; 
	document.onmouseup   = mouseUp;
	
	function makeClickable(object){
		object.onmousedown = function(){
			dragObject = this;
		}
	}
	
	function PopUpClose() {
		indexfGetElem("shamoPopupContent").removeChild(indexfGetElem("shamoPopupContent").firstChild);
		document.body.removeChild(document.getElementById("shamoBlanket"));
		document.body.removeChild(document.getElementById("shamoPopup"));
	}
	
	function mouseUp(ev){
		dragObject = null;
	}
	
	function mouseCoords(ev){ 
	    if(ev.pageX || ev.pageY){ 
	        return {x:ev.pageX, y:ev.pageY}; 
	    } 
	    return { 
	        x:ev.clientX + document.body.scrollLeft - document.body.clientLeft, 
	        y:ev.clientY + document.body.scrollTop  - document.body.clientTop 
	    }; 
	} 
	
	function getMouseOffset(target, ev){
		ev = ev || window.event;
	
		var docPos    = getPosition(target);
		var mousePos  = mouseCoords(ev);
		return {x:mousePos.x - docPos.x, y:mousePos.y - docPos.y};
	}
	
	function getPosition(e){
		var left = 0;
		var top  = 0;
	
		while (e.offsetParent){
			left += e.offsetLeft;
			top  += e.offsetTop;
			e     = e.offsetParent;
		}
	
		left += e.offsetLeft;
		top  += e.offsetTop;
	
		return {x:left, y:top};
	}
	
	function mouseMove(ev){
		ev           = ev || window.event;
		var mousePos = mouseCoords(ev);
		if(dragObject){
			dragObject.style.position = 'absolute';
			dragObject.style.top      = (mousePos.y - mouseOffset.y) + 'px';
			dragObject.style.left     = (mousePos.x - mouseOffset.x) + 'px';
	
			return false;
		}
	}
	
	function indexfgetPageSizeWithScroll(){
		if (window.innerHeight && window.scrollMaxY) {// Firefox
			yWithScroll = window.innerHeight + window.scrollMaxY;
			xWithScroll = window.innerWidth + window.scrollMaxX;
		} else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
			yWithScroll = document.body.scrollHeight;
			xWithScroll = document.body.scrollWidth;
		} else { // works in Explorer 6 Strict, Mozilla (not FF) and Safari
			yWithScroll = document.body.offsetHeight;
			xWithScroll = document.body.offsetWidth;
		}
		arrayPageSizeWithScroll = new Array(xWithScroll,yWithScroll);
		//alert( 'The height is ' + yWithScroll + ' and the width is ' + xWithScroll );
		return arrayPageSizeWithScroll;
	}

	function mouseUp(){
		dragObject = null;
	}

	function makeDraggable(o, popO){
		if(!o || !popO) return;
		o.onmousedown = function(ev){
			dragObject  = popO;
			mouseOffset = getMouseOffset(popO, ev);
			return false;
		}
	}
	
	function shamoPop(title, contHTML, wid) {
		var bdiv = document.createElement('div');
		bdiv.setAttribute('id','shamoBlanket'); 
		bdiv.style.height = indexfgetPageSizeWithScroll()[1] + "px";
		document.body.appendChild(bdiv);
		var popdiv = document.createElement('div'); 
		popdiv.setAttribute('id','shamoPopup'); 
		popdiv.style.width = wid + "px"; 
		//popdiv.style.height = "200px"; 
		popdiv.style.left = "350px"; 
		popdiv.style.top = "200px"; 
		popdiv.style.position = "absolute"; 
		var ptitlebar = document.createElement('div');
		ptitlebar.setAttribute('id','shamoPopupTitleBar');
		//popdiv.style.width = "100%"; 
		ptitlebar.innerHTML = '<table width="100%"><tr><td id="shamoPopupTitleBar">&nbsp;' + title + ' </td><td align="right"><input id="popuptitbarbutton" align="right" type="button" value="x" onmouseover="this.id=\'popuptitbarbuttonMouseOver\'" onmouseout="this.id=\'popuptitbarbutton\'" onClick="PopUpClose();"></td></tr></table>';
		popdiv.appendChild(ptitlebar);
		makeDraggable(ptitlebar,popdiv);
		var contdiv = document.createElement('div'); 
		contdiv.setAttribute('id','shamoPopupContent'); 
		contdiv.innerHTML = contHTML;
		popdiv.appendChild(contdiv);
		document.body.appendChild(popdiv);
	}	
	
	
	function RetRespWithCheck(respText) {		
		var sesExpDelim = '#!3%6$#@458#!2*/-&2@';
		try {
			if(respText.length >= 20 && (respText.indexOf(sesExpDelim) >= 0)) {
				window.location = "index.php";
				return "";
			}
		} catch(error) {}
		return respText;
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//  End -->//////////////////////////////                 //////////////////////////////////////////////////
	
	function ajax() {
	   // Private Declarations
	   var _request = null;
	   var _this = null;
		
	   // Public Declarations
	   this.GetResponseXML = function() {
		  return (_request) ? _request.responseXML : null;
	   }
		
	   this.GetResponseText = function() {
		  return (_request) ? RetRespWithCheck(_request.responseText) : null;
	   }
		
	   this.GetRequestObject = function() {
		  return _request;
	   }
		
		this.GetFormRequest = function (oForm) {
			var aParams = new Array();
			for (var i=0 ; i < oForm.elements.length; i++) {
				if((oForm.elements[i].type == "checkbox" || oForm.elements[i].type == "radio") && oForm.elements[i].checked == false) continue;
				var sParam = encodeURIComponent(oForm.elements[i].name);
				sParam += "=";
				sParam += encodeURIComponent(oForm.elements[i].value);
				aParams.push(sParam);
			}
			return aParams.join("&");
		}
	
		this.InitializeRequest = function(Method, Uri){
		  _InitializeRequest();
		  _this = this;
		
		  if(Uri.indexOf('?') == -1) Uri += "?";
		  else Uri += "&";
		  Uri += 'sid=' + indexfGeneratePassword(10);
		  
		  switch (arguments.length)
		  {
			 case 2:
				_request.open(Method, Uri);
				break;
					
			 case 3:
				_request.open(Method, Uri, arguments[2]);
				break;
		  }
			
		  if (arguments.length >= 4) _request.open(Method, Uri, arguments[2], arguments[3]);
		  this.SetRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
	   }
		this.IsConActive = IsActive;
	   this.SetRequestHeader = function(Field, Value) {
		  if (_request) _request.setRequestHeader(Field, Value);
	   }
		
	   this.Commit = function(Data) {
		  if (_request) _request.send(Data);
	   }
		
	   this.Close = function() {
			if (_request) 
			if (_request) _request.abort();
	   }
		function IsActive() {
			return (_request != null && _request.readyState != 0 && _request.readyState != 4)  ;
		}
		
	   // Public Event Declarations.
	   this.OnUninitialize = function() { };
	   this.OnLoading = function() { };
	   this.OnLoaded = function() { };
	   this.OnInteractive = function() { };
	   this.OnSuccess = function() { };
	   this.OnFailure = function() { };
	   
	   // Private Event Declarations
	   function _OnUninitialize() { _this.OnUninitialize(); };
	   function _OnLoading() { _this.OnLoading(); };
	   function _OnLoaded() { _this.OnLoaded(); };
	   function _OnInteractive() { _this.OnInteractive(); };
	   function _OnSuccess() { _this.OnSuccess(); };
	   function _OnFailure() { _this.OnFailure(); };
	
	   // Private Functions
	   function _InitializeRequest() {
		  _request = _GetRequest();
		  _request.onreadystatechange = _StateHandler;
	   }
		
	   function _StateHandler() {
		  switch (_request.readyState) {
			 case 0:
				window.setTimeout("void(0)", 100);
				_OnUninitialize();
				break;
					
			 case 1:
				window.setTimeout("void(0)", 100);
				_OnLoading();
				break;
					
			 case 2:
				window.setTimeout("void(0)", 100);
				_OnLoaded();
				break;
				
			 case 3:
				window.setTimeout("void(0)", 100);
				_OnInteractive();
				break;
					
			 case 4:
				if (_request.status == 200)
				   _OnSuccess();
				else
				   _OnFailure();
						
				return;
				break;
		  }
	   }

	function _GetRequest() {
			var obj;
			
			try {
			 obj = new XMLHttpRequest();
			}
			catch (error) {
			 try {
				obj = new ActiveXObject("Microsoft.XMLHTTP");
			 }
			 catch (error) {
				return null;
			 }
			}
			return obj;
		}
	}	///end ajax

	////////////////////////////////// SHAMIL///////////////////////////////////
	var	g_callback_array = new Array();	
	var g_av_encrypted = false;	
	function MakeNewAJAXCall(in_url, in_simple_callback, in_method, in_complex_callback, in_param, in_param2, in_timeout_callback, in_timeout_delay ){
		if(!in_method){
			in_method = "GET";
		}
		if(!in_timeout_delay){
			in_timeout_delay = 90;	
		}
		var callback_index = 1;	
		while(g_callback_array[callback_index]&&(typeof(g_callback_array[callback_index])!='undefined')){callback_index++};
		g_callback_array[callback_index] = new Array();
		g_callback_array[callback_index]['request_callback'] = in_simple_callback;
		g_callback_array[callback_index]['request_method'] = in_method;
		g_callback_array[callback_index]['request_complex_callback'] = in_complex_callback;
		g_callback_array[callback_index]['request_param'] = in_param;
		g_callback_array[callback_index]['request_param2'] = in_param2;
		g_callback_array[callback_index]['timeoutcallback'] = in_timeout_callback;
		var funcbody = 'var index='+callback_index+';';
		funcbody += 'var stage=g_callback_array[index]["request_object"].readyState;\
					var resp="";\
					if((navigator.appName!="Microsoft Internet Explorer") || (stage==4)){\
						resp=g_callback_array[index]["request_object"].responseText\
						};\
					if(g_callback_array[index]["request_complex_callback"]){\
						g_callback_array[index]["request_complex_callback"](stage, resp, g_callback_array[index]["request_param"], g_callback_array[index]["request_param2"], index)\
						};\
					if((stage==4) && g_callback_array[index]["request_callback"]){\
						if ( g_av_encrypted ) {\
							resp = av_decrypt ( resp );\
							}\
						g_callback_array[index]["request_callback"](resp, g_callback_array[index]["request_param"], g_callback_array[index]["request_param2"])\
						};\
					if(stage==4){\
						if(g_callback_array[index]["timeout_t"]){clearTimeout(g_callback_array[index]["timeout_t"])};\
						g_callback_array[index]["request_object"]=null;\
						g_callback_array[index]["request_callback"]=null;\
						g_callback_array[index]["request_method"]=null;\
						g_callback_array[index]["request_complex_callback"]=null;\
						g_callback_array[index]["request_param"]=null;\
						g_callback_array[index]["callback"]=null;\
						g_callback_array[index]["timeoutcallback"]=null;\
						g_callback_array[index]=null;\
						}';
	
		var funcbodytimeout = 'var index='+callback_index+';';
		funcbodytimeout += 'if(g_callback_array[index]["request_object"]){g_callback_array[index]["request_object"].onreadystatechange=null;g_callback_array[index]["request_object"].abort()};\
							if(g_callback_array[index]["timeoutcallback"]){g_callback_array[index]["timeoutcallback"](g_callback_array[index]["request_param"], g_callback_array[index]["request_param2"],index)};\
							g_callback_array[index]["request_object"]=null;\
							g_callback_array[index]["request_callback"]=null;\
							g_callback_array[index]["request_method"]=null;\
							g_callback_array[index]["request_complex_callback"]=null;\
							g_callback_array[index]["request_param"]=null;\
							g_callback_array[index]["callback"]=null;\
							g_callback_array[index]["timeoutcallback"]=null;\
							g_callback_array[index]=null;';
		g_callback_array[callback_index]['callback'] = new Function (funcbody);
		g_callback_array[callback_index]['timeout_t'] = setTimeout(new Function (funcbodytimeout),(in_timeout_delay * 1000));
		
		var ret = null;
		if(CallXMLHTTPObject ( in_url, in_method, g_callback_array[callback_index]['callback'], callback_index )){
			ret = callback_index;
		}
		return ret;
	};

	function CallXMLHTTPObject ( in_url, in_method, in_callback, in_index ) {
		try {
			var sVars = null;

			if ( in_method == "POST" ) {
				var rmatch = /^([^\?]*)\?(.*)$/.exec ( in_url );
				
				in_url = rmatch[1];
				sVars = unescape ( rmatch[2] );
			}
			
			// Create the request object and start the request going.
			g_callback_array[in_index]['request_object'] = MakeNewRequestObject();
			g_callback_array[in_index]['request_object'].open(in_method, in_url, true);
	
			if ( in_method == "POST" ) {
				g_callback_array[in_index]['request_object'].setRequestHeader("Method", "POST "+in_url+" HTTP/1.1");
				g_callback_array[in_index]['request_object'].setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			}
			g_callback_array[in_index]['request_object'].onreadystatechange = in_callback;
			g_callback_array[in_index]['request_object'].send(sVars);
			
			return true;
		} catch ( z ) {
		}
		
		return false;
	};
	
	function MakeNewRequestObject() {
		var	ret;
		if ( typeof XMLHttpRequest != 'undefined' ) {
			ret = new XMLHttpRequest();
		} else {
			if (typeof window.XMLHttpRequest != 'undefined') {
				ret = new XMLHttpRequest();
			} else {
					if (window.ActiveXObject) {
						if ( typeof dm_xmlhttprequest_type != 'undefined' ) {
							ret = new ActiveXObject(dm_xmlhttprequest_type);
						} else {
							var versions = ["Msxml2.XMLHTTP.7.0", "Msxml2.XMLHTTP.6.0", "Msxml2.XMLHTTP.5.0", "Msxml2.XMLHTTP.4.0", "MSXML2.XMLHTTP.3.0", "MSXML2.XMLHTTP", "Microsoft.XMLHTTP"];
							for (var i = 0; i < versions.length ; i++) {
								try {
									ret = new ActiveXObject(versions[i]);
									if (ret) {
										dm_xmlhttprequest_type = versions[i];
										break;
									}
								}
								catch (objException) {
								};
							};
						}
				}
			}
		}
		
		return ret;
	};
	
	if (typeof SupportsAjax == 'undefined'){
		function SupportsAjax ( ) {
			var test_obj = MakeNewRequestObject();
			
			if ( test_obj ) {
				test_obj = null;
				return true;
				}
			
			test_obj = null;
			
			return false;
		};
	}
	if ( typeof SimpleAJAXCall == 'undefined' ){
		
		function SimpleAJAXCall ( in_uri, in_callback, in_method, in_param ) {
			if ( (typeof in_method == 'undefined') || ((in_method != 'GET')&&(in_method != 'POST')) ) {
				in_method = 'GET';
				}
			in_method = in_method.toUpperCase();
			
			if ( SupportsAjax() && (typeof in_uri != 'undefined') && in_uri && (typeof in_callback == 'function') ) {
				return MakeNewAJAXCall ( in_uri, in_callback, in_method, null, in_param );
				}
			else {
				return false;
				}
		}
	}	
	
	//////////////////////////////////////////////////
	
	
	
function pageWidth() {
    return window.innerWidth != null ? window.innerWidth : document.documentElement && document.documentElement.clientWidth ? document.documentElement.clientWidth : document.body != null ? document.body.clientWidth : null;
}
function pageHeight() {
    return window.innerHeight != null ? window.innerHeight : document.documentElement && document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body != null ? document.body.clientHeight : null;
}
function posLeft() {
    return typeof window.pageXOffset != 'undefined' ? window.pageXOffset : document.documentElement && document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft ? document.body.scrollLeft : 0;
}
function posTop() {
    return typeof window.pageYOffset != 'undefined' ? window.pageYOffset : document.documentElement && document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop ? document.body.scrollTop : 0;
}
function $(x) {
    return document.getElementById(x);
}
function scrollFix() {
    var obol = $('ol');
    obol.style.top = posTop() + 'px';
    obol.style.left = posLeft() + 'px'
}
function sizeFix() {
    var obol = $('ol');
    obol.style.height = pageHeight() + 'px';
    obol.style.width = pageWidth() + 'px';
}
function kp(e) {
    ky = e ? e.which : event.keyCode;
    if (ky == 88 || ky == 120) hm();
    return false
}
function inf(h) {
    tag = document.getElementsByTagName('select');
    for (i = tag.length - 1; i >= 0; i--) tag[i].style.visibility = h;
    tag = document.getElementsByTagName('iframe');
    for (i = tag.length - 1; i >= 0; i--) tag[i].style.visibility = h;
    tag = document.getElementsByTagName('object');
    for (i = tag.length - 1; i >= 0; i--) tag[i].style.visibility = h;
}
function sm(obl, wd, ht, contObj) {
    var h = 'hidden';
    var b = 'block';
    var p = 'px';
    //alert(contObj.innerHTML);
    var obol = $('ol');
    var obbxd = $('mbd');
    obbxd.innerHTML = $(obl).innerHTML;
    obol.style.height = pageHeight() + p;
    obol.style.width = pageWidth() + p;
    obol.style.top = posTop() + p;
    obol.style.left = posLeft() + p;
    obol.style.display = b;
    var tp = posTop() + ((pageHeight() - ht) / 2) - 12;
    var lt = posLeft() + ((pageWidth() - wd) / 2) - 12;
    var obbx = $('mbox');
    obbx.style.top = (tp < 0 ? 0 : tp) + p;
    obbx.style.left = (lt < 0 ? 0 : lt) + p;
    obbx.style.width = wd + p;
    obbx.style.height = ht + p;
    inf(h);
    obbx.style.display = b;
    //Added by Shamil Mehdiyev
    if(typeof contObj != "undefined") {
        indexfFindChilds(contObj, [['tagName', 'SELECT']], function (o) { o.style.visibility = "visible"; });
    }
    return false;
}
function hm() {
    var v = 'visible';
    var n = 'none';
    $('ol').style.display = n;
    $('mbox').style.display = n;
    inf(v);
    document.onkeypress = ''
}
function initmb() {
    var ab = 'absolute';
    var n = 'none';
    var obody = document.getElementsByTagName('body')[0];
    var frag = document.createDocumentFragment();
    var obol = document.createElement('div');
    obol.setAttribute('id', 'ol');
    obol.style.display = n;
    obol.style.position = ab;
    obol.style.top = 0;
    obol.style.left = 0;
    obol.style.zIndex = 998;
    obol.style.width = '100%';
    frag.appendChild(obol);
    var obbx = document.createElement('div');
    obbx.setAttribute('id', 'mbox');
    obbx.style.display = n;
    obbx.style.position = ab;
    obbx.style.zIndex = 999;
    var obl = document.createElement('span');
    obbx.appendChild(obl);
    var obbxd = document.createElement('div');
    obbxd.setAttribute('id', 'mbd');
    obl.appendChild(obbxd);
    frag.insertBefore(obbx, obol.nextSibling);
    obody.insertBefore(frag, obody.firstChild);
    window.onscroll = scrollFix;
    window.onresize = sizeFix;
}
//window.onload = initmb;

/////////////////////////////////////////////////////////////////////////
/*natiq*/
 function ckBoxState(state,GroupName)
 { 	 	
	for( var i = 1, j; j = indexfGetElem(GroupName+i); i++ ) j.checked = state;
 }	
/////////////////////////////// text area ve.s ucnun limit
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}
	
	
	